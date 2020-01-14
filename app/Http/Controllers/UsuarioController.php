<?php

namespace App\Http\Controllers;

use App\Role;
use App\Models\RoleUser;
use App\Services\ServiceUserRepository;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuarios.index');

    }

    public function datatable(Request $request)
    {
        $pesquisar = $request->get('pesquisar')??"";
        $status = [];
        $mascara = array(".", "/", "-");

        if (strlen($pesquisar)>0){
            if(substr_count ("inativo",strtolower ($pesquisar))>0){
                array_push($status, 0);
            }
            if (substr_count ("ativo",strtolower($pesquisar))>0) {
                array_push($status, 1);
            }

        }

        $query = User::query()
            ->where(function ($q) use ($pesquisar, $status, $mascara){
                $q->orwhereRaw("name like  '%$pesquisar%'");
                $q->orwhereRaw("email like  '%$pesquisar%'");
                $q->orwhere('cnpj_cpf','like','%'. str_replace($mascara,'', $pesquisar).'%');

                if(count($status)) {
                    $q->orWhereIn('status', $status);
                }

            })->get();

        return datatables()->of($query)
            ->editColumn('cnpj_cpf', function ($row) {

                $cnpj_cpf = "";
                if(strlen($row->cnpj_cpf) == 11) {
                    $cnpj_cpf = $this->mascara("###.###.###-##", $row->cnpj_cpf);

                } else {
                    $cnpj_cpf = $this->mascara("##.###.###/####-##", $row->cnpj_cpf);
                }

                return $cnpj_cpf;

            })

            ->editColumn('status', function ($row) {
                if($row->status == 1) {
                    return  "<label class=\"label label-success\">Ativo</label> ";
                }

                if($row->status == 0) {
                    return  "<label class=\"label label-warning\">Inativo</label> ";
                }

            })

            ->addColumn('action', function ($row) {
                $acoes = "";
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Perfil" href="/usuarios/'.$row->id.'/edit" ><i class="fas fa-edit" aria-hidden="true"></i></i></a> ';

                    $acoes .= '<form method="POST" action="/usuarios/' . $row->id . '" class="form" style="display:inline">
                                    <input name="_method" value="DELETE" type="hidden">
                                    ' . csrf_field() . '
                                    <button type="button" class="btn btn-xs btn-danger" title="Excluir Usuário" onclick="alertModal(\'Confirma excluir o Usuário?\',this)">
                                     <i class="far fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </form>';


                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $perfils = $this->getPerfil();
        $perfilSelected = null;
        $status = $this->status();
        $statusSelected = null;
        $tipoPessoaSelected = null;
        $tipoPessoa = $this->tipoPessoa();

        return view('usuarios.create', compact('perfils', 'perfilSelected', 'status', 'statusSelected', 'tipoPessoa', 'tipoPessoaSelected'));
    }

    public function getPerfil()
    {
        $perfis = Role::where('status', 1)->orderBy('display_name')->pluck('display_name', 'id');
        return $perfis;
    }

    public function  store( Request $request, ServiceUserRepository $repository)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'cnpj_cpf' => 'required|unique:users|max:20',
            'role_id' => 'required',
            'status' => 'required',
        ]);

        $requestData = $request->all();
        $response = $repository->create($requestData);

        if($response == "sucess!") {

            Session::flash('alert-success', 'Usuário adicionado!');
        } else {
            Session::flash('alert-danger', 'Erro ao adicionar Usuário!');
        }
        return redirect('usuarios');

    }

    public function edit($id,  ServiceUserRepository $repository)
    {
        $perfils = $this->getPerfil();
        $status = $this->status();
        $tipoPessoa = $this->tipoPessoa();
        $usuario = $repository->show($id);
        $statusSelected = $usuario->status;
        $tipoPessoaSelected = $usuario->tipo_pessoa;

        $perfilSelected =$this->getRoleUser($id);

        if(strlen($usuario->cnpj_cpf) == 11) {
            $usuario->cnpj_cpf = $this->mascara("###.###.###-##", $usuario->cnpj_cpf);

        } else {
            $usuario->cnpj_cpf = $this->mascara("##.###.###/####-##", $usuario->cnpj_cpf);
        }

        return view('usuarios.edit', compact('usuario', 'perfils', 'perfilSelected', 'status', 'statusSelected', 'tipoPessoa', 'tipoPessoaSelected', 'perfilSelected'));
    }

    public function update($id, Request $request,  ServiceUserRepository $repository)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'cnpj_cpf' => 'required',
            'role_id' => 'required',
            'status' => 'required',
        ]);

        $requestData = $request->all();

        $response = $repository->update($id, $requestData);

        if($response == "sucess!") {
            Session::flash('alert-success', 'Usuário alterado!');
        } else {
            Session::flash('alert-danger', 'Erro ao alterar Usuário!');
        }
        return redirect('usuarios');
    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 =>'Inativo'];
        return $status;
    }

    public function validacaoCPFCNPJ( Request $request)
    {
        $documento = null;
        $mensagem = null;

        if(strlen ($request->documento) == 14) {
            $documento = str_replace(['.','.','-'],'',  $request->documento);
        } else {
            $documento = str_replace(['.','.','/','-'],'',  $request->documento);
        }

        $verificaDoc =  User::where('cnpj_cpf', $documento)->exists();

        if($verificaDoc) {
            $mensagem = "documento existe";
        } else {
            $mensagem = "documento liberado";
        }

        return json_encode($mensagem);
    }


    public function getRoleUser($id)
    {
        $roleUser = RoleUser::where('user_id', $id)->pluck('role_id')->toArray();

        return $roleUser;
    }

    function mascara($mask, $str)
    {
        $str = str_replace(" ","",$str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
        return $mask;
    }

    function tipoPessoa()
    {
        $tipoPessoa = [0 => 'Pessoa Física', 1 => 'Pessoa Jurídica'];

        return $tipoPessoa;
    }




}
