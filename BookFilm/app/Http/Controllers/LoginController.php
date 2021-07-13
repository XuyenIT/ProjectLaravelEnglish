<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class LoginController extends Controller
{
    //
    public function Login(){
    	return view('login.login');
    }

    public function FormLogin(Request $request){
    	$account = $request->get("Account");
    	$password = $request->get("Password");

    	if(DB::table('users')->where('Account', $account)->where('Password', $password)->count() > 0){
            if($account == "admin"){
                $user = DB::table('users')
                    ->where('Account', $account)
                    ->where('Password', $password)
                    ->first();
                
                Session::put('admin', $user);
                return redirect('/Admin/Home');
            }else{
                $user = DB::table('users')
                ->where('Account', $account)
                ->where('Password', $password)
                ->first();
                if($user->Status == false){
                    Session::flash('error', 'Tài khoản của bạn đã bị khóa.');
                    return redirect('/dang-nhap.html');
                }else{
                    Session::put('user', $user);
                    return redirect('/');
                }
            }
    		
    	}else{
            Session::flash('error', 'Sai tên đăng nhập hoặc mật khẩu. Vui lòng đăng nhập lại.');
    		return redirect('/dang-nhap.html');
    	}
    }

    public function Register(){
    	return view('login.register');
    }

    public function FormRegister(Request $request){
    	$Account = $request->get("Account");
    	$Password = $request->get("Password");
    	$Fullname = $request->get("Fullname");
    	$Address = $request->get("Address");
    	$Phone = $request->get("Phone");
    	$Sex = $request->get("Sex");
    	$BirthDay = $request->get("BirthDay");

        $isExist = DB::table('users')
                ->where('Account', $Account)
                ->count();
        if($isExist > 0){
            Session::flash('error', 'Tài khoản bạn đăng ký đã có, vui lòng nhập lại.');
            return redirect('/dang-ky.html');
        }else{
            DB::insert('insert into users 
                (Account, Password, Fullname, Address, Phone, Sex, BirthDay, Type, status) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                [$Account, $Password, $Fullname, $Address, $Phone, $Sex, $BirthDay, 1, 1]);

            Session::flash('error', 'Đăng ký tài khoản thành công. Vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }        
    	
    }

    public function ChangePass(){
        return view('login.changePass');
    }

    public function FormChangePass(Request $request){
    	$OldPass = $request->get("OldPass");
    	$NewPass = $request->get("NewPass");

    	$user = Session::get('user');
        if($user == null){
            Session::flash('error', 'Bạn vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }

    	if($user->Password != $OldPass){
    		Session::flash('error', 'Mật khẩu cũ không trùng, vui lòng nhập lại.');
    		return redirect('/doi-mat-khau.html');
    	}else{
    		DB::update('update users set Password = ? where ID = ?', [$NewPass, $user->ID]);

    		Session::forget('user');
    		Session::flash('error', 'Đổi mật khẩu thành công, vui lòng đăng nhập lại.');
    		return redirect('/dang-nhap.html');
    	}
    	
    }

    public function HistoryTicket()
    {
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');
        $user = Session::get('user');

        if($user == null){
            Session::flash('error', 'Bạn vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }

        $query = DB::table('book_ticket')
                        ->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
                        ->join('users', 'users.ID', '=', 'book_ticket.User_ID')
                        ->where('users.ID', $user->ID)
                        ->select('book_ticket.ID','book_ticket.Date','book_ticket.Time','book_ticket.CreatedDate','book_ticket.Sit','book_ticket.CountTicket','book_ticket.TotalPrice','book_ticket.Status','film.Name','film.ReleaseDate')
                        ->orderBy('book_ticket.CreatedDate', 'desc')
                        ->paginate(10);
        $member = DB::table('member')
                        ->where('User_ID', $user->ID)
                        ->first();                

        //phim đang chiếu
        $MoviePlay = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->take(10)
                        ->get();

        //phim sắp chiếu
        $ComingMovie = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                        ->take(10)
                        ->get();
        return view('login.history_ticket')->with([
                                            'query'=> $query,
                                            'member'=> $member,
                                            'MoviePlay'=> $MoviePlay,
                                            'ComingMovie'=> $ComingMovie
                                        ]);
    }

    public function DetailTicket($BookTicket_ID){
        $DateNow = Carbon::now('Asia/Ho_Chi_Minh');
        $ticket = DB::table('book_ticket')
                        ->join('film', 'film.ID', '=', 'book_ticket.Film_ID')
                        ->join('users', 'users.ID', '=', 'book_ticket.User_ID')
                        ->where('book_ticket.ID', $BookTicket_ID)
                        ->select('film.Name','users.Fullname','book_ticket.TotalPrice','book_ticket.Sit')
                        ->first();
        $food_drink = DB::table('book_fd')
                        ->join('book_ticket', 'book_ticket.ID', '=', 'book_fd.BookTicket_ID')
                        ->join('food_drink', 'food_drink.ID', '=', 'book_fd.FoodDrink_ID')
                        ->where('book_fd.BookTicket_ID', $BookTicket_ID)
                        ->select('book_fd.Quantity','food_drink.Name')
                        ->get();
        //phim đang chiếu
        $MoviePlay = DB::table('film')
                        ->where('ReleaseDate', '<', $DateNow)
                        ->take(10)
                        ->get();

        //phim sắp chiếu
        $ComingMovie = DB::table('film')
                        ->where('ReleaseDate', '>=', $DateNow)
                        ->take(10)
                        ->get();
        return view('login.detail')->with([
                                            'food_drink'=> $food_drink,
                                            'ticket'=> $ticket,
                                            'MoviePlay'=> $MoviePlay,
                                            'ComingMovie'=> $ComingMovie
                                        ]);
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
        Session::put('user', $user);
        $user = Session::get('user');
        Session::flash('error', 'Cập nhật thông tin thành công.');

        return redirect()->action(
                    [LoginController::class, 'UpdateUser'], ['user' => $user]
        );
    }

    public function UpdateUser(){

        $user = Session::get('user');

        if($user == null){
            Session::flash('error', 'Bạn vui lòng đăng nhập để tiếp tục.');
            return redirect('/dang-nhap.html');
        }
        return view('login.update')->with([
                                            'user'=> $user
                                        ]);
    }

    

    public function logout(){
        Session::forget('user');
    	Session::forget('admin');
    	return redirect('/');
    }
}
