<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 20/02/20
 * Time: 11:07
 */

namespace Modules\Parameters\Models;


use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameters';

    protected $primaryKey = "parameter_id";

    protected $fillable = [
        'description',
        'file',
        'taxation',
        'exchange_rate',
        'freight'
    ];

}