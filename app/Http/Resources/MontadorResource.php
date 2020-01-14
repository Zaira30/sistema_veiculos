<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 14/01/20
 * Time: 01:12
 */

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;

class MontadorResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'status'  => ($this->status == 1)? 'Ativo': 'inativo',
        ];
    }
}