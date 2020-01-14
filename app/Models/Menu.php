<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 13/12/19
 * Time: 11:52
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends  Model
{
    protected $table = 't001_menu';

    protected $primaryKey = "a001_id_menu";

    protected $fillable = [
        'a001_descricao',
        'a001_url',
        'a001_ordem',
        'a001_status',
        'a001_id_pai',
        'created_at_user',
        'updated_at_user'
    ];

    public function Permission()
    {
        return $this->hasMany('App\Permission', 'a001_id_menu', 'a001_id_menu');
    }





}