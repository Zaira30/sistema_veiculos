<?php

namespace App\Http\Controllers;

use App\Models\Montador;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class MontadoresController extends Controller
{
    public function index()
    {
        return view('montadores.index');
    }

    public function datatable(Request $request)
    {
        $query = Montador::query()->get();

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
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Montador" href="/montadores/' . $row->id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                    $acoes .= '<form method="POST" action="/montadores/' . $row->id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Marca" onclick="alertModal(\'Confirma excluir a Montador?\',this)">
                                 <i class="far fa-trash-alt" aria-hidden="true"></i>
                                </button>
                            </form>';

                return $acoes;
            }) ->escapeColumns(['*'])
            ->make(true);
    }

    public function create()
    {
        $status = $this->status();
        $statusSelected = null;
        return view('montadores.create', compact('status', 'statusSelected'));

    }

    public function store( Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'status' => 'required'
        ]);

        $requestData = $request->all();
        Montador::create($requestData);

        Session::flash('alert-success', 'Montador adicionada!');
        return redirect('montadores');

    }

    public function edit($id)
    {
        $montador = Montador::find($id);

        $status = $this->status();
        $statusSelected = null;
        return view('montadores.edit', compact('status', 'statusSelected', 'montador'));

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'status' => 'required'
        ]);


        $requestData = $request->all();
        Montador::find($id)->update($requestData);

        Session::flash('alert-success', 'Montador adicionada!');

        return redirect('montadores');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $veiculos = Veiculo::where('montador_id', $id)->exists();

            if($veiculos) {
                Session::flash('alert-danger', 'Não foi possível excluir o motador!');
                return redirect('montadores');
            }

            Montador::where('id', $id)->delete();
            Session::flash('alert-danger', 'Montador excluído!');
            DB::commit();
            return redirect('montadores');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o motador!');
            return redirect('montadores');
        }

    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 => 'Inativo'];
        return $status;
    }
}
