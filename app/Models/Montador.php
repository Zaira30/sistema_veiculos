<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 13/01/20
 * Time: 23:39
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Montador extends  Model
{
    protected $table = 'montadores';

    protected $primaryKey = "id";

    protected $fillable = [
        'nome',
        'status'
    ];


    public function Veiculo()
    {
        return $this->hasMany('App\Models\Veiculo', 'montador_id', 'id');
    }

}