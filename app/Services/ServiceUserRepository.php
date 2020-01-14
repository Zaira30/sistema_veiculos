<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 09/12/19
 * Time: 15:08
 */

namespace App\Services;


use App\Mail\CadastroSenha;
use App\Models\RoleUser;
use App\User;
use App\Base\BaseRepository;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Mail;



class ServiceUserRepository extends BaseRepository
{
    public function getModel()
    {
        return  $this->model = new User();
    }

    public function show($id)
    {
        $user = $this->getModel();
        return $user->where('id', $id)->first();
    }

    public function create($data)
    {
      //  dd( $data['role_id']);
        DB::beginTransaction();
        try {

            $tokenCreate = isset($data['_token']) ? $data['_token'] : str_random(50);
            $key = str_random(64);

            if(strlen($data['cnpj_cpf']) == 14) {
                $cnpj_cpf = remove_mask_cpf($data['cnpj_cpf']);
            } else {
                $cnpj_cpf = remove_mask_cnpj($data['cnpj_cpf']);
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'cnpj_cpf' => $cnpj_cpf,
                'remember_token' => $tokenCreate,
                'x-api-key' => $key,
                'status' => $data['status'],
                'cep' => !empty($data['cep']) ? $data['cep'] : null,
                'bairro' =>  !empty($data['bairro']) ? $data['bairro'] : null,
                'cidade' =>  !empty($data['cidade']) ? $data['cidade'] : null,
                'endereco' =>  !empty($data['endereco']) ? $data['endereco'] : null,
                'complemento' =>  !empty($data['complemento']) ? $data['complemento'] : null,
                'numero' =>  !empty($data['numero']) ? $data['numero'] : null
            ]);

            $role_ids = $data['role_id'];

            foreach ($role_ids as $key => $value) {

                RoleUser::create([
                    'user_id' => $user->id,
                    'role_id' => $value
                ]);
            }

            Mail::to($user->email)->send(new CadastroSenha($user));

            DB::commit();
            $mensage = "sucess!";

        }catch (\Exception $e) {

            DB::rollBack();
            dd($e);
            $mensage = "error!";
        }

        return $mensage;

    }

    public function update($id, $data)
    {
        DB::beginTransaction();

        try {

            $tokenCreate = isset($data['_token']) ? $data['_token'] : str_random(50);
            $key = str_random(64);

            if(strlen($data['cnpj_cpf']) == 14) {
                $cnpj_cpf = remove_mask_cpf($data['cnpj_cpf']);
            } else {
                $cnpj_cpf = remove_mask_cnpj($data['cnpj_cpf']);
            }

            User::find($id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'cnpj_cpf' => $cnpj_cpf,
       /*         'remember_token' => $tokenCreate,
                'x-api-key' => $key,*/
                'status' => $data['status'],
                'cep' => !empty($data['cep']) ? $data['cep'] : null,
                'bairro' =>  !empty($data['bairro']) ? $data['bairro'] : null,
                'cidade' =>  !empty($data['cidade']) ? $data['cidade'] : null,
                'endereco' =>  !empty($data['endereco']) ? $data['endereco'] : null,
                'complemento' =>  !empty($data['complemento']) ? $data['complemento'] : null,
                'numero' =>  !empty($data['numero']) ? $data['numero'] : null

            ]);

            RoleUser::where('user_id', $id)->delete();

            $role_ids = $data['role_id'];

            foreach ($role_ids as $key => $value) {

                RoleUser::create([
                    'user_id' => $id,
                    'role_id' => $value
                ]);
            }

            DB::commit();
            $mensage = "sucess!";

        }catch (\Exception $e) {

            DB::rollBack();
            dd($e);
            $mensage = "error!";
        }

        return $mensage;



    }

    //public function destroy(){}


}