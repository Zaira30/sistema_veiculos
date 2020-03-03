<?php
/**
 * Created by PhpStorm.
 * User: zaira
 * Date: 25/02/20
 * Time: 18:03
 */

namespace Modules\Budget\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Budget\Models\BudgetProduct;


class Budget extends Model
{
    protected $table = 'budgets';

    protected $primaryKey = "budget_id";

    protected $fillable = [
        'number_budget',
        'name',
        'email',
        'phone',
        'backorder',
        'doctor',
        'date',
        'cpf',
        'total',
        'freight'
    ];


    public function budgetProduct()
    {
        return $this->hasMany('Modules\Budget\Models\BudgetProduct', 'budget_id', 'budget_id');
    }


}