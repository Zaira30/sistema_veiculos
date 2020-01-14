<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 13/01/20
 * Time: 23:39
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends  Model
{
    protected $table = 'veiculos';

    protected $primaryKey = "id";

    protected $fillable = [
        'montador_id',
        'nome',
        'ano_fabricacao',
        'ano_modelo',
        'chassi',
        'status'
    ];
    public function Montador()
    {
        return $this->hasOne('App\Models\Montador', 'id', 'montador_id');
    }

}