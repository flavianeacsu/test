<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Producer;

class ProductController extends Controller
{
    public function create()
    {
    	$products = Product::latest()->get();
    	$producers = Producer::latest()->get();
    	return view('create', compact('products','producers'));
    }

    public function store()
    {
    	//validate
    	$this->validate(request(), [
    		'name' => 'required',
    		'description' => 'required',
    		'producer' => 'required'
    	]);

    	//get producer_id
    	$producer_id = Producer::where('name',request('producer'))->first()->id;

    	//store product
    	Product::create([
    		'name' => request('name'),
    		'description' => request('description'),
    		'producer_id' => $producer_id
    	]);

    	//redirect
    	return redirect()->home();
    }
}
