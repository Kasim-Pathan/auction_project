<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class fetchController extends Controller
{
    function fetchCategory(){
    $category = DB::table('categories')
                    ->leftJoin('products', 'categories.id', '=', 'products.category_id')
                    ->select('categories.*', DB::raw('COUNT(products.name) as closing_balance'))
                    ->groupBy('categories.id')
                    ->get();
// dd($category->toArray());
    $product=Product::orderBy('id','desc')->get();

    return view('user.index',compact('category','product'));
    }
    function product_detail($id){
        $product=Product::find($id);
        // dd($product->toarray());
        return view('user.product-details',compact('product'));
    }
    function category_all($id){
        $category=Categorie::find($id);
        $product=Product::where('category_id',$id)->get();
        // dd($product->toArray());
        return view('user.product',compact('product','category'));
    }
}