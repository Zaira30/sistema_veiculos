<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Budget\Models\Budget;
use Modules\Products\Models\Product;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;
use Modules\Store\Models\Store;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('products::index');
    }

    public function datatable(Request $request)
    {
        $query = Product::with('store')->get();

       // dd($query );

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

                $acoes .= '<a class="btn btn-xs btn-mypharma" title="Editar Produto" href="/products/' . $row->product_id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                $acoes .= '<form method="POST" action="/products/' . $row->product_id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Categoria" onclick="alertModal(\'Confirma excluir o Produto?\',this)">
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
        $backOrder = $this->backOrder();
        $backOrderSelected = null;
        $stores = $this->getStore();
        return view('products::create', compact('status', 'statusSelected', 'backOrder', 'backOrderSelected', 'stores'));
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
            'price' => 'required',
            'file' => 'required',
            'status' => 'required',
            'store_id' => 'required'
        ]);

        $requestData = $request->all();

        if ($request->file) {
            $image = $request->file('file');

            $path = public_path(). '/images_products/';

            $filename =  time() . '.' . $image->getClientOriginalExtension();

            $image->move($path, $filename);

            $requestData['file'] = '/images_products/'.$filename;
        } else {
            $requestData['file'] = null;
        }

        if(isset($requestData['price'])) {

            $requestData['price'] = str_replace(',', '.', $requestData['price']);
            $requestData['price'] = number_format($requestData['price'], 2, '.', '');
        }


        Product::create($requestData);

        Session::flash('alert-success', 'Produto adicionado!');

        return redirect('products');

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('products::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $status = $this->status();
        $statusSelected = null;
        $backOrder = $this->backOrder();
        $backOrderSelected = null;
        $stores = $this->getStore();


        $product = Product::find($id);


        return view('products::edit',  compact('status', 'statusSelected', 'backOrder', 'backOrderSelected', 'stores', 'product'));
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
            'price' => 'required',
            'status' => 'required',
            'store_id' => 'required'
        ]);

        $requestData = $request->all();

        if ($request->file) {
            $image = $request->file('file');

            $path = public_path(). '/images_products/';

            $filename =  time() . '.' . $image->getClientOriginalExtension();

            $image->move($path, $filename);

            $requestData['file'] = '/images_products/'.$filename;
        } else {
            $requestData['file'] = $request->imagem_db;
        }

        if(isset($requestData['price'])) {

            $requestData['price'] = str_replace(',', '.', $requestData['price']);
            $requestData['price'] = number_format($requestData['price'], 2, '.', '');
        }


        Product::find($id)->update($requestData);

        Session::flash('alert-success', 'Produto atualizado!');


        return redirect('products');

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

            Product::where('product_id', $id)->delete();

            Session::flash('alert-danger', 'Produto excluído!');
            DB::commit();
            return redirect('products');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o Produto!');
            return redirect('products');
        }
    }

    public function status()
    {
        $status = [ 1 => 'Ativo', 0 => 'Inativo'];
        return $status;
    }

    public function backOrder()
    {
        $tipo = [1 => 'Sim', 0 => 'Não'];
        return $tipo;
    }

    public function getStore()
    {
        $store = Store::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'store_id')->prepend('', '');
        return $store;
    }


}
