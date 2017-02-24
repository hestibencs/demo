<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	public $timestamps = false;
    protected $table = 'product';

    public function accompaniment()
    {
        return $this->hasMany('App\Accompaniment', 'product_id', 'id');
    }
}
