<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Modules\Store\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('store::index');
    }


    public function datatable(Request $request)
    {
        $query = Store::query()->get();

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

                $acoes .= '<a class="btn btn-xs btn-mypharma" title="Editar Loja" href="/store/' . $row->store_id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                $acoes .= '<form method="POST" action="/store/' . $row->store_id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Categoria" onclick="alertModal(\'Confirma excluir a Loja?\',this)">
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
        return view('store::create',  compact('status', 'statusSelected'));
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
            'url' => 'required'
        ]);

        $requestData = $request->all();

        if ($request->file) {
            $image = $request->file('file');

            $path = public_path(). '/images_store/';

            $filename =  time() . '.' . $image->getClientOriginalExtension();

            $image->move($path, $filename);

            $requestData['file'] = '/images_store/'.$filename;
        } else {
            $requestData['file'] = null;
        }

        if(isset($requestData['freight'])) {

            $requestData['freight'] = str_replace(',', '.', $requestData['freight']);
            $requestData['freight'] = number_format($requestData['freight'], 2, '.', '');
        }

        if(isset($requestData['taxation'])) {

            $requestData['taxation'] = str_replace(',', '.', $requestData['taxation']);
            $requestData['taxation'] = number_format($requestData['taxation'], 2, '.', '');
        }

        if(isset($requestData['exchange_rate'])) {

            $requestData['exchange_rate'] = str_replace(',', '.', $requestData['exchange_rate']);
            $requestData['exchange_rate'] = number_format($requestData['exchange_rate'], 2, '.', '');
        }



        Store::create($requestData);

        Session::flash('alert-success', 'Loja adicionada!');

        return redirect('store');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        return view('store::show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status = $this->status();


        $store  = Store::find($id);
        $statusSelected = $store->status;
        $imagem_store = null;

        return view('store::edit', compact('status', 'store', 'statusSelected', 'imagem_store'));
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
            'url' => 'required'
        ]);


        $requestData = $request->all();

        if ($request->file) {
            $image = $request->file('file');

            $path = public_path(). '/images_store/';

            $filename =  time() . '.' . $image->getClientOriginalExtension();

            $image->move($path, $filename);

            $requestData['file'] = '/images_store/'.$filename;
        } else {
            $requestData['file'] = $request->imagem_db;
        }

        if(isset($requestData['freight'])) {

            $requestData['freight'] = str_replace(',', '.', $requestData['freight']);
            $requestData['freight'] = number_format($requestData['freight'], 2, '.', '');
        }

        if(isset($requestData['taxation'])) {

            $requestData['taxation'] = str_replace(',', '.', $requestData['taxation']);
            $requestData['taxation'] = number_format($requestData['taxation'], 2, '.', '');
        }

        if(isset($requestData['exchange_rate'])) {

            $requestData['exchange_rate'] = str_replace(',', '.', $requestData['exchange_rate']);
            $requestData['exchange_rate'] = number_format($requestData['exchange_rate'], 2, '.', '');
        }




        Store::find($id)->update($requestData);

        Session::flash('alert-success', 'Loja atualizada!');
        return redirect('store');

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

            Store::where('store_id', $id)->delete();

            Session::flash('alert-danger', 'Loja excluída!');
            DB::commit();
            return redirect('store');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir a Loja!');
            return redirect('store');
        }
    }

    public function status()
    {
        $status = [1 => 'Ativo', 0 => 'Inativo'];

        return $status;
    }
}
