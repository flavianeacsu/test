<?php

namespace App;

class Product extends Model
{
    public function producer()
    {
    	$this.belongsTo(Producer::class);
    }
}
