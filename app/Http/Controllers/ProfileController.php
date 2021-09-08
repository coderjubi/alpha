<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class ProfileController extends Controller
{
    function profileedit(){
        return view('admin.profile.index');
    }
    function namechange(Request $request){
        $user_id = Auth::id();
        User::find($user_id)->update([
            'name'=>$request->name,
        ]);
        return back()->with('success', 'Name Updated!');
    }

    function passchange(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>'required',
            'password'=>'confirmed',
            'password'=>Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(),
        ]);

        // $upper = preg_match('@[A-Z]@', $request->password);
        // $lower = preg_match('@[a-z]@', $request->password);
        // $number = preg_match('@[0-9]@', $request->password);
        // $spsl = preg_match('@[#,$,*,&]@', $request->password);

        // $strong_password = $upper.$lower.$number.$spsl;
        // if($strong_password == 1111){
        //     echo 'ho strong ache password';
        // }
        // else {
        //     echo 'durbol password';
        // }

        if(Hash::check($request->old_password, Auth::user()->password)){
            $user_id = Auth::id();
            User::find($user_id)->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('passsuccess', 'Password Updated!');
        }
        else {
            return back()->with('wrong_pass', 'Old Password Not Correct!');
        }

    }

    function photochange(Request $request){
        $request->validate([
            'profile_photo'=>'image',
            'profile_photo'=>'file|max:512',
        ]);

        if(Auth::user()->profile_photo != 'default.jpg'){
            $delete_path = public_path()."/uploads/profile/".Auth::user()->profile_photo;
            unlink($delete_path);
        }
        
        $new_profile_photo = $request->profile_photo;
        $extension = $new_profile_photo->getClientOriginalExtension();
        $new_photo_name = Auth::id().'.'.$extension;
        
        Image::make($new_profile_photo)->save(base_path('public/uploads/profile/'.$new_photo_name));
        User::find(Auth::id())->update([
            'profile_photo'=>$new_photo_name,
        ]);
        return back();
    }
}
