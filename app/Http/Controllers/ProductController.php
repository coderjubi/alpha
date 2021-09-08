<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\subcategory;
use App\Models\Product;
use Carbon\Carbon;
use Image;



class ProductController extends Controller
{
    function index(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $products = Product::all();
        return view('admin.product.index', compact('categories', 'subcategories', 'products'));
    }

    function insert(Request $request){
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_desp'=>$request->product_desp,
            'product_quantity'=>$request->product_quantity,
            'created_at'=>Carbon::now(),
        ]);
        
        $new_product_image = $request->product_image;
        $extension = $new_product_image->getClientOriginalExtension();
        $new_product_name = $product_id.'.'.$extension;
        
        Image::make($new_product_image)->save(base_path('public/uploads/product/'.$new_product_name));
        Product::find($product_id)->update([
            'product_image'=>$new_product_name,
        ]);


        return back()->with('success', 'Product Added Successfully!');
    }
}
