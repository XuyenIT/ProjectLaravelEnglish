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
            Session::flash('error', 'Bạn vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }

    	if($admin->Password != $OldPass){
    		Session::flash('error', 'Mật khẩu cũ không trùng, vui lòng nhập lại.');
    		return redirect('/Admin/ChangePass');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $admin->ID]);

    		Session::forget('admin');
    		Session::flash('error', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại.');
    		return redirect('/dang-nhap.html');
    	}
    	
    }
}
