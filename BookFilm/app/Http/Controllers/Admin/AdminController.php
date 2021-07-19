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

    		Session::flash('error', 'Password does not match, enter again.');

    		return redirect('/Admin/ChangePass');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $admin->ID]);

    		Session::forget('admin');

    		Session::flash('success', 'Change password success, please login again.');

    		return redirect('/dang-nhap.html');
    	}

    }

    public function Update(Request $request){
        $ID = $request->get("ID");
        $Fullname = $request->get("Fullname");
        $Address = $request->get("Address");
        $Phone = $request->get("Phone");
        $BirthDay = $request->get("BirthDay");


        DB::update('update users set Fullname = ?, Address = ?, Phone = ?, BirthDay = ?  where ID = ?',
                [$Fullname, $Address, $Phone, $BirthDay, $ID]);

         $user = DB::table('users')
                ->where('ID', $ID)
                ->first();
        Session::put('admin', $user);
        $user = Session::get('admin');
        Session::flash('error', 'Update information succesful.');

        return redirect()->action(
                    [AdminController::class, 'UpdateUser'], ['admin' => $user]
        );
    }

    public function UpdateUser(){

        $user = Session::get('admin');

        if($user == null){
            Session::flash('error', 'Please login to continue.');
            return redirect('/dang-nhap.html');
        }
        return view('admin.admin.upadate')->with([
                                            'admin'=> $user
                                        ]);
    }

    public function registerAdmin() {
        return view("admin.admin.register");
    }

    public function FormRegister(Request $request){
    	$Account = $request->get("Account");
        $Email = $request->get('Email');
    	$Password = $request->get("Password");
    	$Fullname = $request->get("Fullname");
    	$Address = $request->get("Address");
    	$Phone = $request->get("Phone");
    	$Sex = $request->get("Sex");
    	$BirthDay = $request->get("BirthDay");

        $isExist = DB::table('users')
                ->where('Account', $Account)
                ->count();
        $isEmail = DB::table('users')->where('Email', $Email)->count();
        if($isExist > 0){
            Session::flash('error', 'Your account already exists, Please enter again.');
            return redirect('/Admin/registerAdmin');
        } elseif($isEmail > 0) {
            Session::flash('error', 'Your Email already exists, Please enter again.');
            return redirect('/Admin/registerAdmin');
        }
            DB::insert('insert into users
                (Account, Email, Password, Fullname, Address, Phone, Sex, BirthDay, Type, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [$Account, $Email, $Password, $Fullname, $Address, $Phone, $Sex, $BirthDay, 2, 1]);
            Session::flash('success', 'Your account has successfully registered.');
            return redirect('/Admin/User/indexAdmin');

    }
}
