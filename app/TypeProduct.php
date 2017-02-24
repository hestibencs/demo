<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{

	public $timestamps = false;
    protected $table = 'type_product';

    public function product()
    {
        return $this->hasMany('App\Product', 'type_product_id', 'id');
    }
}
