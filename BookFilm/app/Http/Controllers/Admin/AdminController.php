<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class AdminController extends Controller
{
    //
    public function ChangePass(){
        return view('admin.admin.changePass');
    }

    public function FormChangePass(Request $request){
    	$OldPass = $request->get("OldPass");
    	$NewPass = $request->get("NewPass");

    	$admin = Session::get('admin');
        if($admin == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }

    	if($admin->Password != $OldPass){
    		Session::flash('error', 'The old password does not match, please re-enter it.');
    		return redirect('/Admin/ChangePass');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $admin->ID]);

    		Session::forget('admin');
    		Session::flash('error', 'Change password successfully, please login again.');
    		return redirect('/dang-nhap.html');
    	}
    	
    }
}
