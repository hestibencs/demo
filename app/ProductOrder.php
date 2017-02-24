<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
	
	public $timestamps = false;
	protected $table = 'product_order';

    public function accompanimentPay()
    {
        return $this->hasMany('App\AccompanimentPay', 'product_order_id', 'id');
    }
}
