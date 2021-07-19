<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Exception;
use File;

class UserController extends Controller
{
    //
    public function Index()
    {
    	# code...
        $type = 1;
    	$query = DB::table('users')
    					->where('Type', $type)
                        ->orderBy('ID', 'desc')
            			->paginate(10);
        $member = DB::table('member')->get();

        return view('admin.user.index')->with([
    										'query'=> $query,
    										'member'=> $member
    									]);
    }

    public function IndexAdmin()
    {
    	# code...
        $type = 2;
    	$query = DB::table('users')
    					->where('Type', $type)
                        ->orderBy('ID', 'desc')
            			->paginate(10);
        $member = DB::table('member')->get();

        return view('admin.user.admin')->with([
    										'query'=> $query,
    										'member'=> $member
    									]);
    }


    public function ChangeStatus($ID){
    	$user = DB::table('users')->where('ID', $ID)->first();
    	$status = "";
    	if($user->Status == true)
    		$status = false;
    	else
    		$status = true;
    	DB::update('update users set Status = ? where ID = ?', [$status, $ID]);
    	return response()->json([
    		'success' => 'Record deleted successfully!'
    	]);
    }

     public function DeleteUser($ID){
         $isExit =  DB::table('book_ticket')->where("User_ID", $ID)->count();
         $isComment = DB::table('comment')->where("User_ID", $ID)->count();
         if($isExit > 0){
            return back()->with('error','You cannot delete it.Because The user account is related to the ticket list!!!');
         }else if( $isComment > 0){
            return back()->with('error','You cannot delete it.Because The user account is related to the Feedback manager!!!');
         }
         DB::table('users')->where("ID", $ID)->delete();
         return back()->with('success','Record deleted successfully!!');

       /*  DB::table('users')->where("ID", $ID)->delete();
        if(!$flag) {
            return back()->withErrors(['error'=>'You cannot delete it.Because The user account is related to the ticket list!!!']);
        }
        return back()->with('success','Record deleted successfully!!'); */
      /*   return response()->json([
         'success' => 'Record deleted successfully!'
     ]); */
    }
}
