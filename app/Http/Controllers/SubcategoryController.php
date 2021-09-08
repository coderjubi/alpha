<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use App\Http\Requests\SubcategoryPost;

class SubcategoryController extends Controller
{
    function index(){
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $deleted_subcategories = Subcategory::onlyTrashed()->get();
        return view('admin.subcategory.index', compact('categories', 'subcategories', 'deleted_subcategories'));
    }

    function insert(SubcategoryPost $request){

        if(Subcategory::withTrashed()->where('category_id', $request->category_id)->where('subcategory_name', $request->subcategory_name)->exists()){
            return back()->with('subcategory_exist', 'Subcategory Already Exist!');
        }
        else {
            Subcategory::insert([
                'category_id'=>$request->category_id,
                'subcategory_name'=>$request->subcategory_name,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success', 'subcategory Added Successfully!');
        }
    }
    function delete($subcategory_id){
        Subcategory::find($subcategory_id)->delete();
        return back();
    }
    function restore($deleted_subcategory_id){
        Subcategory::withTrashed()->find($deleted_subcategory_id)->restore();
        return back();
    }
    function perdelete($deleted_subcategory_id){
        Subcategory::withTrashed()->find($deleted_subcategory_id)->forceDelete();
        return back();
    }
    function markdelete(Request $request){

        // if($request->delete){
        //     echo 'delete button asche';
        // }
        // else {
        //     echo 'kam kaj nai asche';
        // }


        // die();

        if($request->marked_id){
            foreach($request->marked_id as $single_mark){
                Subcategory::find($single_mark)->delete();
            }
        }
        return back();
    }

    function edit($subcategory_id){
        $subcategories = Subcategory::find($subcategory_id);
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategories', 'categories'));
    }

    function update(Request $request){
        Subcategory::find($request->subcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
        ]);
        return back()->with('update', 'Subcategory Updated!');
    }
}
