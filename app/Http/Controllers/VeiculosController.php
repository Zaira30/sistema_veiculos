<?php

namespace App\Http\Controllers;

use App\Models\Montador;
use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class VeiculosController extends Controller
{
    public function index()
    {
        return view('veiculos.index');
    }

    public function datatable(Request $request)
    {
        $query = Veiculo::with('Montador')->get();
/*        dd($query);*/

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
                    $acoes .= '<a class="btn btn-xs btn-primary" title="Editar Veículo" href="/veiculos/' . $row->id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                    $acoes .= '<form method="POST" action="/veiculos/' . $row->id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Veículo" onclick="alertModal(\'Confirma excluir o Veículo?\',this)">
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
        $montadores = $this->getMontadores();
        return view('veiculos.create', compact('status', 'statusSelected', 'montadores'));

    }

    public function store( Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'status' => 'required',
            'montador_id' => 'required',
            'chassi' => 'required',
            'ano_fabricacao' => 'required',
            'ano_modelo' => 'required'
        ]);

        $requestData = $request->all();
        Veiculo::create($requestData);

        Session::flash('alert-success', 'Veículo adicionado!');
        return redirect('veiculos');

    }

    public function edit($id)
    {
        $veiculo = Veiculo::find($id);

        $status = $this->status();
        $statusSelected = null;
        $montadores = $this->getMontadores();
        return view('veiculos.edit', compact('status', 'statusSelected', 'veiculo', 'montadores'));

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'status' => 'required',
            'montador_id' => 'required',
            'chassi' => 'required',
            'ano_fabricacao' => 'required',
            'ano_modelo' => 'required'
        ]);


        $requestData = $request->all();
        Veiculo::find($id)->update($requestData);

        Session::flash('alert-success', 'Veículo alterado!');

        return redirect('veiculos');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            Veiculo::where('id', $id)->delete();
            Session::flash('alert-danger', 'Veículo excluído!');
            DB::commit();
            return redirect('veiculos');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o veiculo!');
            return redirect('veiculos');
        }

    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 => 'Inativo'];
        return $status;
    }

    public function getMontadores()
    {
        $montadores = Montador::where('status', 1)->orderBy('nome', 'asc')->pluck('nome', 'id')->prepend('', '');
        return $montadores;
    }
}
