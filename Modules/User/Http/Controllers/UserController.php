<?php

namespace Modules\User\Http\Controllers;

use App\Mail\CadastroSenha;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }

    public function datatable(Request $request)
    {
        $query = User::query()->get();

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

                $acoes .= '<a class="btn btn-xs btn-mypharma" title="Editar Usuario" href="/user/' . $row->id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                $acoes .= '<form method="POST" action="/user/' . $row->id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Usuário" onclick="alertModal(\'Confirma excluir Usuário?\',this)">
                                 <i class="far fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </form>';


                return $acoes;
            }) ->escapeColumns(['*'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status = $this->status();
        $statusSelected = null;
        return view('user::create', compact('status', 'statusSelected'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'email' => 'required'
        ]);

        $requestData = $request->all();

        $tokenCreate = isset($requestData['_token']) ? $requestData['_token'] : str_random(50);
        $key = str_random(64);

        $user = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'remember_token' => $tokenCreate,
            'x-api-key' => $key,
            'status' => $requestData['status'],
        ]);

        Mail::to($user->email)->send(new CadastroSenha($user));

        Session::flash('alert-success', 'Usuário adicionado!');

        return redirect('user');


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $status = $this->status();
        $statusSelected = $user->status;
        return view('user::edit', compact('user', 'status', 'statusSelected'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'email' => 'required'
        ]);


        $requestData = $request->all();

        User::find($id)->update([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'status' => $requestData['status']
        ]);

        Session::flash('alert-success', 'Usuário alterado!');

        return redirect('user');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            User::where('id', $id)->delete();

            Session::flash('alert-danger', 'Usuário excluído!');
            DB::commit();
            return redirect('user');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o usuário!');
            return redirect('user');
        }
    }

    public function status()
    {
        $status = [1=> 'Ativo', 0 => 'Inativo'];
        return $status;
    }
}
