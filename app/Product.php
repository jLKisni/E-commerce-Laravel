<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function presetPrice(){

    	return '$ '.number_format($this->price / 100,2);
    }

    
}
