<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    //protected $fillable = ['title','body']; //ce permiti sa fie inserat in bd
    protected $guarded = [] ; //ce protejezi
}