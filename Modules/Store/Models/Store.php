<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 19/02/20
 * Time: 10:41
 */

namespace Modules\Store\Models;


use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';

    protected $primaryKey = "store_id";

    protected $fillable = [
        'name',
        'freight',
        'taxation',
        'exchange_rate',
        'url',
        'file',
        'status',
    ];

    public function products()
    {
        return $this->hasMany('Modules\Products\Models\Products', 'store_id', 'store_id');

    }

}