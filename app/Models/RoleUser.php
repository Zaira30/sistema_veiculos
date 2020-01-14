<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 12/12/19
 * Time: 12:41
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id'
    ];

}