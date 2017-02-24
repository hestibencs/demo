<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPay extends Model
{
	
	public $timestamps = false;
	protected $table = 'order_pay';

    public function productOrder()
    {
        return $this->hasMany('App\ProductOrder', 'order_pay_id', 'id')->with('accompaniment');
    }
}
