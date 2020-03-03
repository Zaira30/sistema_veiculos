<?php

namespace Modules\Parameters\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Parameters\Models\Parameter;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

class ParametersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $parametro = Parameter::exists();
        $dataParametro = null;

        if($parametro) {
            $dataParametro = Parameter::first();
        }


        return view('parameters::index', compact('dataParametro'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required'

        ]);

        $requestData = $request->all();

        if(isset($requestData['freight'])) {

            $requestData['freight'] = str_replace(',', '.', $requestData['freight']);
            $requestData['freight'] = number_format($requestData['freight'], 2, '.', '');
        }

        if(isset($requestData['taxation'])) {

            $requestData['taxation'] = str_replace('%', '', $requestData['taxation']);
        }

        if(isset($requestData['exchange_rate'])) {

            $requestData['exchange_rate'] = str_replace(',', '.', $requestData['exchange_rate']);
            $requestData['exchange_rate'] = number_format($requestData['exchange_rate'], 2, '.', '');
        }



        if ($request->file) {
            $image = $request->file('file');

            $path = public_path(). '/images_parameters/';

            $filename =  time() . '.' . $image->getClientOriginalExtension();

            $image->move($path, $filename);

            $requestData['file'] = '/images_parameters/'.$filename;
        } else {
            $requestData['file'] = $request->imagem_db;
        }


        $id = !empty($requestData['id']) ? $requestData['id'] : null;

        if( $id != null) {

            Parameter::find($id)->update([
                                            'description' => $requestData['description'],
                                            'file' => $requestData['file'],
                                            'freight' => $requestData['freight'],
                                            'taxation' => $requestData['taxation'],
                                            'exchange_rate' => $requestData['exchange_rate']
                                         ]);
        } else {

            Parameter::create(['description' => $requestData['description'], 'file' => $requestData['file']]);
        }

        Session::flash('alert-success', 'Parâmentro Salvo!');

        return redirect('parameters');
    }

}
