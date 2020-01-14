<?php

namespace App\Http\Controllers;

use App\Services\ServiceUserRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

class SenhaController extends Controller
{
    public function  alterarSenhe( Request $request)
    {
        try {
            $data = $request->only('token');
            $token = $data['token'];

            return view('usuarios.recuperarsenha', compact('token'));
        } catch(\Exception $e) {
            Session::flash('alert-danger', 'Token inválido!');
            return redirect('/');
        }
    }

    public function novaSenha(Request $request, ServiceUserRepository $repository)
    {
        $token = $request->token;
        $password = bcrypt($request->password);

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        $user = $repository->getModel();

        $usuario = $user->where('remember_token', $token)->first();

        if(!isset($usuario)){
            return response()->json(['message' => 'Não foi possível alterar a Senha!\nSenha Inválida.','status'=> false], 200, $header, JSON_UNESCAPED_UNICODE);
        }else{

            DB::beginTransaction();
            try {

                $usuario->password = $password;
                $usuario->updated_at = Carbon::now();
                $usuario->remember_token = "";
                $usuario->save();


                DB::commit();
                return response()->json(['message' => 'Senha alterada com sucesso.','status'=> true], 200, $header, JSON_UNESCAPED_UNICODE);

            }catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'Não foi possível alterar o Password.','status'=> false], 200, $header, JSON_UNESCAPED_UNICODE);
            }

        }
    }


    public function esqueciMinhaSenha()
    {

    }



}
