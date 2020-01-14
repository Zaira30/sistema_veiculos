<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 14/01/20
 * Time: 01:36
 */

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;


class VeiculoResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'montador(a)' =>$this->montador->nome,
            'ano_fabricacao' =>$this->ano_fabricacao,
            'ano_modelo' =>$this->ano_modelo,
            'chassi' =>$this->chassi,
            'status'  => ($this->status == 1)? 'Ativo': 'inativo',
        ];
    }

}