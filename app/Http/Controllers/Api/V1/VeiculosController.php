<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 14/01/20
 * Time: 01:04
 */

namespace App\Http\Controllers\Api\V1;
use App\Repositories\VeiculoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Response;


class VeiculosController extends Controller
{
    public function search(Request $request, VeiculoRepository $repository)
    {

        $xApiKey = 'sGab2Yh6OGxqNl23U34iSklSvg9oXsdN0griA8M7BceY9vcvX0MMsWJiM6ER7mxQ';

        $veiculos = $repository->getByFilter(
            $request['search'],
            $request['status']
        );

        return Response::success('Veiculos retornado com sucesso.',
            [
                'veiculos' => $veiculos
            ], $xApiKey
        );
    }

}