<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 12/12/19
 * Time: 12:41
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $table = 'permission_role';

    protected $fillable = [
        'permission_id',
        'role_id',
    ];


}