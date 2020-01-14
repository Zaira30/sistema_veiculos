<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 29/11/19
 * Time: 15:11
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 't001_perfil';

    protected $primaryKey = "a001_id_perfil";

    protected $fillable = [
        'a001_descricao_perfil',
        'a001_status_perfil',
    ];

}