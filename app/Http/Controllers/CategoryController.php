<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryPost;

class CategoryController extends Controller
{
    function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    function insert(CategoryPost $request){
        Category::insert([
            'category_name'=>$request->category_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success', 'Category Added Succesfully');
    }

    function delete($category_id){
        Category::find($category_id)->delete();
        return back()->with('delsuccess', 'Category Deleted Successfully!');
    }
}
