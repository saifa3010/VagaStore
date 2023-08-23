<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $products = Product::with(['Category'])->Where('status','=','active')->latest()->take(8)->get();

        return view('front.home',compact('products'));
        
    }
}
