<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Perfil;
use App\Models\PermissionRole;
use App\Role;
use App\Models\RoleUser;
use App\Services\ServicePerfilRepository;
use App\User;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class PerfilController extends Controller
{
    public function  index()
    {
        return view('perfis.index');

    }

    public function datatable(Request $request)
    {
        $pesquisar = $request->get('pesquisar')??"";
        $status = [];

        if (strlen($pesquisar)>0){
            if(substr_count ("inativo",strtolower ($pesquisar))>0){
                array_push($status, 0);
            }
            if (substr_count ("ativo",strtolower($pesquisar))>0) {
                array_push($status, 1);
            }

        }


        $query = Role::query()
            ->where(function ($q) use ($pesquisar, $status){
                $q->whereRaw("name like  '%$pesquisar%'");

                if(count($status)) {
                    $q->orWhereIn('status', $status);
                }

            })->get();


        return datatables()->of($query)
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
             /*   if(Auth::user()->can('show-perfil')) {*/
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Perfil" href="/perfis/' . $row->id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';
//                }
//
          /*      if(Auth::user()->can('delete-perfil')) {*/
                    $acoes .= '<form method="POST" action="/perfis/' . $row->id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Perfil" onclick="alertModal(\'Confirma excluir o Perfil?\',this)">
                                 <i class="far fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </form>';

             /*   }*/

                return $acoes;
            })
            ->escapeColumns(['*'])
            ->make(true);

    }


    public function create()
    {
        $status = $this->status();
        $statusSelected = null;
        $usuarios = $this->getUsuarios();
        $menus = $this->getMenu();
        $usuariosSelect = null;
        //$permissoes = null;
        $permissoes = array();

        return view('perfis.create', compact('status', 'statusSelected', 'usuarios', 'menus', 'usuariosSelect', 'permissoes'));
    }

    public function store(Request $request )
    {
        $this->validate($request, [
            'display_name' => 'required|unique:roles|max:255',
            'status' => 'required'
        ]);

        $requestData = $request->all();

        $requestData['name'] = $requestData['display_name'];

        $roles = Role::create($requestData);

        $usuarios = $requestData['user_id'];

        $permissoes = $requestData['permissao'];


        foreach ( $permissoes as $key => $permissao) {
            PermissionRole::create([
                'permission_id' => $permissao,
                'role_id' => $roles->id,

            ]);
        }

        foreach ($usuarios as $key => $usuario) {

            RoleUser::create([
                'user_id' => $usuario,
                'role_id' => $roles->id
            ]);
        }

        Session::flash('alert-success', 'Perfil adicionado!');

        return redirect('perfis');

    }

    public function edit($id)
    {
        $status = $this->status();
        $perfil = Role::find($id);
        $usuarios = $this->getUsuarios();
        $menus = $this->getMenu();
        $usuariosSelect = $this->userPerfil($id);
        $statusSelected = $perfil->status;

        $permissoes = $this->getPermissionRole($id);

        return view('perfis.edit', compact('status', 'statusSelected', 'perfil', 'usuarios', 'menus', 'usuariosSelect', 'permissoes'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request, [
            'display_name' => 'required',
            'status' => 'required'
        ]);

        $requestData = $request->all();

        Role::find($id)->update($requestData);

        $usuarios = $requestData['user_id'];
        $permissoes = $requestData['permissao'];
        
       //exclui as permissoes e cria novamente
        PermissionRole::where('role_id', $id)->delete();
        RoleUser::where('role_id', $id)->delete();

        foreach ( $permissoes as $key => $permissao) {
            PermissionRole::create([
                'permission_id' => $permissao,
                'role_id' => $id,
            ]);
        }

        foreach ($usuarios as $key => $usuario) {

            RoleUser::create([
                'user_id' => $usuario,
                'role_id' => $id
            ]);
        }


        Session::flash('alert-success', 'Perfil atualizado!');
        return redirect('perfis');
    }

    public function destroy($id, ServicePerfilRepository $repository)
    {
        DB::beginTransaction();
        try {
            $usuarios = User::where('a001_id_perfil', $id)->exists();

            if($usuarios) {
                Session::flash('alert-danger', 'Não foi possível excluir o perfil');
                DB::commit();
                return redirect('perfis');
            }

            Perfil::where('a001_id_perfil', $id)->delete();


            Session::flash('alert-danger', 'Perfil excluído!');
            DB::commit();
            return redirect('perfis');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o perfil!');
            return redirect('perfis');
        }
    }

    public function getMenu()
    {
        $menuPrincipal = array();

        $menus = Menu::with('Permission')
                        ->whereNull('a001_id_pai')
                        ->where('a001_status', 1)
                        ->orderBy('a001_ordem', 'ASC')
                        ->get();

        foreach ( $menus as $value) {

            $menuPrincipal[$value->a001_id_menu] = ['id' => $value ->a001_id_menu, 'name' => $value->a001_descricao, 'permissoes' => $value->Permission];
        }

        foreach ( $menuPrincipal as $value) {

            $menuSub = Menu::with('Permission')
                            ->where('a001_id_pai', $value['id'])->where('a001_status', 1)
                            ->orderBy('a001_ordem', 'ASC')->get();

            foreach ($menuSub as $sub) {
                $menuPrincipal[$value['id']]['submenu'][] = ['id' =>$sub->a001_id_menu, 'text' => $sub->a001_descricao,  'url' =>  $sub->a001_url, 'permissoes' => $sub->Permission];
            }
        }


        return $menuPrincipal;
    }


    public function getPermissionRole($id)
    {
        $permissionRole = PermissionRole::where('role_id', $id)->pluck('permission_id')->toArray();

        return $permissionRole;
    }

    public function getUsuarios()
    {
        $usuarios = User::where('status', 1)->orderBy('name')->pluck('name', 'id');
        return $usuarios;
    }

    public function userPerfil($id)
    {
        $usuariosSelect = RoleUser::where('role_id', $id)->pluck('user_id')->toArray();

        return $usuariosSelect;

    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 =>'Inativo'];
        return $status;
    }
}
