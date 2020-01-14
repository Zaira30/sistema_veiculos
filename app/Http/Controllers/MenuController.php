<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Permission;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
class MenuController extends Controller
{
    public function index()
    {
        return view('menus.index');
    }

    public function datatable(Request $request)
    {
        $query = Menu::query()->get();

        return datatables()->of($query)
            ->editColumn('a001_status', function ($row) {
                if($row->a001_status == 1) {
                    return  "<label class=\"label label-success\">Ativo</label> ";
                }

                if($row->a001_status == 0) {
                    return  "<label class=\"label label-warning\">Inativo</label> ";
                }

            })

            ->addColumn('action', function ($row) {
                $acoes = "";
                $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Perfil" href="/menus/'.$row->a001_id_menu.'/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';

                $acoes .= '<form method="POST" action="/menus/' . $row->a001_id_menu . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Menu" onclick="alertModal(\'Confirma excluir o Menu?\',this)">
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
        $status = $this->status();
        $statusSelected = null;
        $menuSelect = null;
        $menus = $this->getMenu();

        return view('menus.create', compact('status', 'statusSelected', 'menus', 'menuSelect'));
    }

    public function store( Request $request)
    {
        $this->validate($request, [
            'a001_descricao' => 'required|unique:t001_menu|max:255',
            'a001_ordem' => 'required',
            'a001_status' => 'required',
            'a001_url' => 'required'
        ]);

        $requestData = $request->all();
        $requestData['created_at_user'] = Auth::User()->id;
        $requestData['a001_url'] = strtolower(  $requestData['a001_url']);

       $menu =  Menu::create($requestData);

       $model = strtolower($requestData['a001_descricao']);

       $permissoes = ['create', 'show', 'edit', 'delete'];

       foreach ($permissoes as $permissao) {

           $name = $permissao."-".$model;

           Permission::create([
               'name' => $name,
               'display_name' => $name,
               'description' => 'Creação de permissão ' . $name,
               'a001_id_menu' => $menu->a001_id_menu
           ]);
       }

        Session::flash('alert-success', 'Menu adicionado!');

        return redirect('menus');

    }

    public function edit($id)
    {
        $menu = Menu::find($id);
        $status = $this->status();
        $statusSelected = $menu->status;
        $menuSelect = $menu->role_id;
        $menus = $this->getMenu();

        return view('menus.edit', compact('status', 'statusSelected', 'menus', 'menuSelect', 'menu'));

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
       /*     'a001_descricao' => 'required|unique:t001_menu|max:255',*/
            'a001_ordem' => 'required',
            'a001_status' => 'required',
            'a001_url' => 'required'

        ]);

        $requestData = $request->all();
        $requestData['updated_at_user'] =Auth::User()->id;
        $requestData['a001_url'] = strtolower(  $requestData['a001_url']);

        Menu::find($id)->update($requestData);

        Session::flash('alert-success', 'Menu atualizado!');
        return redirect('menus');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            /* $role_user = RoleUser::where('role_id', $id)->exists();
             dd(RoleUser::where('role_id', $id)->exists());

             $permission_role = PermissionRole::where('role_id', $id)->exists();

             if($role_user == true || $permission_role == true) {
                 Session::flash('alert-danger', 'Não foi possível excluir o menu');
                 DB::commit();
                 return redirect('menus');
             }*/

            Permission::where('a001_id_menu', $id)->delete();

            Menu::where('a001_id_menu', $id)->delete();


            Session::flash('alert-danger', 'Menu excluído!');
            DB::commit();
            return redirect('menus');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o menu!');
            return redirect('menus');
        }
    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 =>'Inativo'];
        return $status;
    }

    public function getMenu()
    {
        $menu = Menu::where('a001_status', 1)->orderBy('a001_descricao')->pluck('a001_descricao', 'a001_id_menu')->prepend('', '');
        return $menu;
    }
}
