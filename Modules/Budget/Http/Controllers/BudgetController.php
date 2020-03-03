<?php

namespace Modules\Budget\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Budget\Models\Budget;
use Modules\Budget\Models\BudgetProduct;
use Modules\Parameters\Models\Parameter;
use Modules\Products\Models\Product;
use Modules\Store\Models\Store;
use Illuminate\Support\Facades\DB;
use Session;
use Auth;
use Entrust;
use Carbon\Carbon;
use Dompdf\Dompdf;
use File;
use Illuminate\Support\Facades\Response;


class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('budget::index');
    }

    public function datatable(Request $request)
    {
        $query = Budget::query()->get();

        return datatables()->of($query)
            ->editColumn('date', function ($row) {
                $row->date = Carbon::createFromFormat('Y-m-d', substr($row->date, 0, 10))->format('d/m/Y');
               return $row->date;


            })->addColumn('action', function ($row) {
                $acoes = "";


                $link = "budget/pdf/".$row->number_budget;

                $acoes .= '<a class="btn btn-danger" title="PDF" href="'.$link.'"  style="font-size: 27px"><i class="fas fa-file-pdf"></i></a> ';

                $acoes .= '<a class="btn btn-xs btn-mypharma" title="Editar Orçamento" href="/budget/' . $row->budget_id . '/edit" ><i class="fas fa-edit" aria-hidden="true"></i></a> ';


                $acoes .= '<form method="POST" action="/budget/' . $row->budget_id . '" class="form" style="display:inline">
                                <input name="_method" value="DELETE" type="hidden">
                                ' . csrf_field() . '
                                <button type="button" class="btn btn-xs btn-danger" title="Excluir Orçamento" onclick="alertModal(\'Confirma excluir o Orçamento?\',this)">
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
        $stores = $this->getStore();
        $products = array();
        $productSelect = null;
        $codigo = $this->generateCode();

        $parametros = Parameter::first();

        return view('budget::create', compact('stores', 'products', 'productSelect', 'codigo', 'parametros'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'number_budget' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'doctor' => 'required',
        ]);

        $requestData = $request->all();

        $requestData['cpf'] =  str_replace(['.','.','-'],'',  $requestData['cpf']);

        $requestData['phone'] = str_replace(['(',')','-'],'',  $requestData['phone']);
        $requestData['phone'] =str_replace(' ','', $requestData['phone']);

        $produtos = $requestData['product_id'];


        if(isset($requestData['freight'])) {

            $requestData['freight'] = str_replace(',', '.', $requestData['freight']);
            $requestData['freight'] = number_format($requestData['freight'], 2, '.', '');
        }

        if(isset($requestData['total'])) {

            $requestData['total'] = str_replace(',', '.', $requestData['total']);
            $requestData['total'] = number_format($requestData['total'], 2, '.', '');
        }


        DB::beginTransaction();
        try {

            $budget = Budget::create([
                                            'number_budget' => $requestData['number_budget'],
                                            'name' => $requestData['name'],
                                            'cpf' => isset($requestData['cpf']) ? $requestData['cpf'] : null,
                                            'email' => $requestData['email'],
                                            'phone' => $requestData['phone'],
                                            'doctor' => $requestData['doctor'],
                                            'freight' => isset($requestData['freight']) ? $requestData['freight'] : null,
                                            'total' => isset($requestData['total']) ? $requestData['total'] : null,
                                            'date' => date('y-m-d')
                                        ]);


            foreach ( $produtos as $key => $value) {

                BudgetProduct::create([
                    'budget_id' => $budget->budget_id,
                    'product_id' => $value,
                    'price' => $requestData['price'][$key],
                    'variation' => $requestData['variation'][$key],
                    'quantity' => $requestData['quantity'][$key],
                ]);
            }

            $this->gerarpdf($budget->budget_id);


            Session::flash('alert-success', 'Orçamento adicionado!');
            DB::commit();
            return redirect('budget');
        } catch (\Exception $e) {

            dd($e);
            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível adicionar o Orçamento!');
            return redirect('budget');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {


        return view('budget::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $budget = Budget::with('budgetProduct')->find($id);
        $stores = $this->getStore();
        $products = array();
        $productSelect = null;
        $codigo = $budget->number_budget;

        if(strlen($budget->phone) == 10){
            $budget->phone = $this->mascara("(##)####-####", $budget->phone);
        } else if(strlen($budget->phone) == 11) {
            $budget->phone = $this->mascara("(##)#####-####", $budget->phone);
        }



        $parametros = Parameter::first();

        return view('budget::edit',  compact('budget', 'codigo', 'stores', 'productSelect', 'products', 'parametros'));
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
            'number_budget' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'doctor' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $requestData = $request->all();

            $requestData['cpf'] =  str_replace(['.','.','-'],'',  $requestData['cpf']);

            $requestData['phone'] = str_replace(['(',')','-'],'',  $requestData['phone']);
            $requestData['phone'] =str_replace(' ','', $requestData['phone']);

            $produtos = $requestData['product_id'];


            if(isset($requestData['freight'])) {

                $requestData['freight'] = str_replace(',', '.', $requestData['freight']);
                $requestData['freight'] = number_format($requestData['freight'], 2, '.', '');
            }

            if(isset($requestData['total'])) {

                $requestData['total'] = str_replace(',', '.', $requestData['total']);
                $requestData['total'] = number_format($requestData['total'], 2, '.', '');
            }

            Budget::find($id)->update([
                                        'number_budget' => $requestData['number_budget'],
                                        'name' => $requestData['name'],
                                        'cpf' => isset($requestData['cpf']) ? $requestData['cpf'] : null,
                                        'email' => $requestData['email'],
                                        'phone' => $requestData['phone'],
                                        'doctor' => $requestData['doctor'],
                                        'freight' => isset($requestData['freight']) ? $requestData['freight'] : null,
                                        'total' => isset($requestData['total']) ? $requestData['total'] : null,
                     ]);


            BudgetProduct::where('budget_id', $id)->delete();


            foreach ( $produtos as $key => $value) {

                BudgetProduct::create([
                    'budget_id' => $id,
                    'product_id' => $value,
                    'price' => $requestData['price'][$key],
                    'variation' => $requestData['variation'][$key],
                    'quantity' => $requestData['quantity'][$key],
                ]);
            }


            $this->gerarpdf($id);

            Session::flash('alert-success', 'Orçamento alterado!');
            DB::commit();
            return redirect('budget');
        } catch (\Exception $e) {

            dd($e);
            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível alterar o Orçamento!');
            return redirect('budget');
        }



    }


    public function getStore()
    {
        $stores = Store::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'store_id')->prepend('', '');
        return $stores;
    }


    public function getProducts (Request $request)
    {
        $id = $request->store_id;

        $products = Product::where(['status' => 1, 'store_id' => $id])->get();

        return   $products = json_encode($products);

    }

    public function getDataProduto(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        return   $product = json_encode($product);


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

            BudgetProduct::where('budget_id', $id)->delete('budget_id');
            Budget::where('budget_id', $id)->delete();

            Session::flash('alert-danger', 'Orçamento excluído!');
            DB::commit();
            return redirect('budget');
        } catch (\Exception $e) {

            DB::rollBack();
            Session::flash('alert-danger', 'Não foi possível excluir o Orçamento!');
            return redirect('budget');
        }
    }
    public function generateCode()
    {

        $date = date('y-m-d');
        $codigo = 0;

        $dt = str_replace("-", "", $date);

        $budget =  Budget::whereDate('created_at', $date)->first();

        if($budget) {

               $sub_cod = substr($budget->number_budget, -2);
               if($sub_cod <= 9) {
                   $sub_cod +=1;
                   $codigo = $dt.'0'.$sub_cod;
               } else
                   $codigo = $dt.$sub_cod;

        } else {

            $codigo = $dt.'01';
        }

        return $codigo;
    }

    public function getCpf( Request $request)
    {
        $cpf = str_replace(['.','.','-'],'',  $request->cpf);
        $dados = null;
        $paciente = Budget::where('cpf', $cpf)->first();

        if($paciente) {
            $dados = json_encode($paciente);
        }
        return $dados;
    }

    public function gerarpdf($id)
    {

        $parametro = Parameter::first();
        $budget = Budget::with('budgetProduct')->find($id);

        $budget->date = Carbon::createFromFormat('Y-m-d', substr($budget->date, 0, 10))->format('d/m/Y');

        $parametro->freight = number_format($parametro->freight,2,",",".");

        $budget->total =  number_format($budget->total,2,",",".");


        $html = view('budget::budget', ['parametro' => $parametro, 'budget' => $budget])->render();


        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setBasePath('/../');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $timestamp =  $budget->number_budget;
        $filename = $timestamp . '.pdf';
        $file = $dompdf->output();
        $path = public_path(). '/pdfs/';
        file_put_contents($path.$filename, $file);


        return true;
    }

    public function downloadPdf($id)
    {
        $file = $id.'.pdf';
        $path = public_path(). '/pdfs/';
        $arquivo = $path.$file;
        return Response::download($arquivo);
    }

    function mascara($mask, $str)
    {
        $str = str_replace(" ","",$str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }
        return $mask;
    }


}
