<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 11/12/19
 * Time: 11:38
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'a001_id_menu'
    ];

}