<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 21/02/20
 * Time: 08:41
 */

namespace Modules\Products\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = "product_id";

    protected $fillable = [
        'name',
        'variation',
        'file',
        'price',
        'backorder',
        'status',
        'store_id'
    ];

    public function budgetProduct()
    {
        return $this->hasOne('Modules\Budget\Models\BudgetProduct', 'product_id', 'product_id');
    }

    public function store()
    {
        return $this->hasOne('Modules\Store\Models\Store', 'store_id', 'store_id');

    }

}