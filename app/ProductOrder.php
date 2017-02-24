<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
	
	public $timestamps = false;
	protected $table = 'product_order';

    public function accompaniment()
    {
        return $this->hasMany('App\Accompaniment', 'product_order_id', 'id');
    }
}
