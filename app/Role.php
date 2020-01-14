<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 11/12/19
 * Time: 11:37
 */

namespace App;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $table = 'roles';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'status',
        'role_id',
        'icon'
    ];

}