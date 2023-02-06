<?php

namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $product = Product::where('status',0)->get();
        $category = Category::where('status',0)->get();
        $brand = Brands::where('status',0)->get();
        $slider = Slider::where('status',0)->get();
        return view('client.product_home',compact('slider','category','brand','product'));
    }

    public function category($slug){

        $category_title = Category::where('slug',$slug)->first();
        $category_product = Product::where('id_category',$category_title->id)->get();
        $count = count($category_product);
        $category = Category::where('status',0)->get();
        $brand = Brands::where('status',0)->get();
        $slider = Slider::where('status',0)->get();
        return view('client.category_product',compact('category_title','category_product','category','brand','slider','count'));
    }
    public function brand($slug){

        $brand_title = Brands::where('slug',$slug)->first();
        $brand_product = Product::where('id_brand',$brand_title->id)->get();
        $count = count($brand_product);
        $category = Category::where('status',0)->get();
        $brand = Brands::where('status',0)->get();
        $slider = Slider::where('status',0)->get();
        return view('client.brand_product',compact('brand_title','brand_product','category','brand','slider','count'));
    }
    public function details($slug){
       $product_details = Product::where('slug',$slug)->first();
       $product = Product::where('id',$product_details->id)->first();
        $category = Category::where('status',0)->get();
        $brand = Brands::where('status',0)->get();
        $slider = Slider::where('status',0)->get();
        return view('client.details',compact('category','brand','slider','product'));
    }

}
