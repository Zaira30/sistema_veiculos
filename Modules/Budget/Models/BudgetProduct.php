<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 25/02/20
 * Time: 18:10
 */

namespace Modules\Budget\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Budget\Budget;

class BudgetProduct extends Model
{
    protected $table = 'budget_products';

    protected $primaryKey = "budget_product_id";

    protected $fillable = [
        'budget_id',
        'product_id',
        'price',
        'variation',
        'quantity',
        'freight'
    ];

    public function budget()
    {
        return $this->hasOne('Modules\Budget\Models\Budget', 'budget_id', 'budget_id');
    }

    public function produto()
    {
        return $this->hasOne('Modules\Products\Models\Product', 'product_id', 'product_id');
    }

}