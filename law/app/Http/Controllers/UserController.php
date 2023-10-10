<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Session;
use App\Models\Lawyer;
use App\Models\City;
use App\Models\Field;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\Course;
use App\Models\Libraries;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Customer;
use App\Models\CustomOrder;
use App\Models\CustomOrderOffer;
use DB;

class UserController extends Controller
{
    public function user_data(){
        $UserData = session()->get('UserData');
        return $UserData;
    }//END public function user_data()
    public function show_users() {
        $Users = User::where('status','=','1')->get();
        return view('users/users',compact('Users'));
    }//END public function show_users()
    public function add_user(Request $request) {
//  return $request;
    $InsertedUserID = 0;
    $UserData =  $this ->user_data();
    $CurrentDateTime = date('Y-m-d h:i:s', Time());
//  $Insert = User::create([
//      'Email' =>$request->Email,
//      'FullName' => $request->FullName,
//      'PhoneNumber' =>$request->PhoneNumber,
//      'Password' =>bcrypt($request->Password) ,
//      'Status' =>1,
//      'CUserID' =>$UserData->UserID,
//      'CDate' =>$CurrentDateTime
//  ]);

$values = array('Email' =>$request->Email,
        'FullName' => $request->FullName,
        'PhoneNumber' =>$request->PhoneNumber,
        'Password' =>bcrypt($request->Password) ,
        'Status' =>1,
        'CUserID' =>$UserData->UserID,
        'CDate' =>$CurrentDateTime);
   $Insert =  DB::table('users')->insert($values);

//  $InsertedUserID = $Insert->id;
    // return $InsertedUserID;


    if ($Insert) {

        return response()->json([
            'status' => true,
            'msg'    => 'Success',
        ]);
    } //END
    else {
        return response()->json([
            'status' => false,
            'msg'    => 'Faild',
        ]);
        }
    }//END public function add_user(Request $request)


    public function login_form(){
        return view('users/login');
    }//END public function login_form()
    public function user_login(Request $request) {
        // return $request;
        $user_name = $request->user_name;
        $user_password = $request->user_password;
        $UserData = User::
        where([['Email','=',$user_name],['status','=','1']])
        ->orwhere([['PhoneNumber','=',$user_name],['status','=','1']])
        ->first();
        // return $UserData;
        if(!empty($UserData)) {
            $check_user_password = Hash::check($user_password, $UserData->Password);
        }//end if(!empty($user))
        if(!empty($UserData) and $check_user_password) {
            $FullName = $UserData->FullName;
            $UserID = $UserData->UserID;
            session()->put(['UserData' => $UserData]);
            $UserData = session()->get('UserData');
            // return $user_data;
            if(!empty($UserData)) {
                return response()->json([
                'url'=>url('/admin/dashboard'),
                'status' => true,
                ]);
            }// END if(!empty($user_data))
        else{
            return response()->json([
            'status' => false,
                ]);
        }//END else
        }// END if(!empty($UserData) and $check_user_password)
        else{
            return response()->json([
            'status' => false,
            ]);
        }//END else
    }//END public function user_login(Request $request)

        public function show_user($UserID) {
        $update_user = User::where('UserID','=',$UserID)->first();;
        return view("users/update_user",compact('update_user'));
    }//END public function show_user($UserID)

    public function update_user(Request $request) {
        $UserID = $request->UpdateUserID;
        $find_user = User::where('UserID','=',$UserID)->first();
        $UserData =  $this ->user_data();
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $Password = "";
        if(!empty($request->Password))
        {
            $Password = bcrypt($request->Password);
        }//END if(isset($request->user_password))
        else {
            $Password = $find_user->Password;
        }

        // return $user_password;

        $update_user_query = DB::table('users')->where('UserID', $UserID)
        ->update(
            ['FullName'=>$request->FullName,
            'Email' =>$request->Email,
            'Password'=>$Password,
            'PhoneNumber'=>$request->PhoneNumber,
            'UUserID' => $UserData->UserID,
            'UDate'   => $CurrentDateTime
            ],
        );

        if($update_user_query) {
            return response()-> json([
            'status' => true,
            'msg'    => 'تم التعديل بنجاح',
            ]);
        }//END $update_user_query
        else {
            return response()-> json([
            'status' => false,
            'msg'    => 'Faild Of Add New Offer',
            ]); 
        }//end else

        // return $update_user_query;

        // return $request;

}//END public function update_user(Request $request)


public function delete_user(Request $request){
        $UserID = $request->id;
        $find_user = User::where('UserID','=',$UserID)->first();
        $DeletedEmail = $find_user->Email."_".$UserID;
        $DeletedPhoneNumber = $find_user->PhoneNumber."_".$UserID;
        $UserData =  $this ->user_data();
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $delete_user = $update_user_query = DB::table('users')->where('UserID', $UserID)
        ->update(
            [
            'Email' => $DeletedEmail,
            'PhoneNumber' => $DeletedPhoneNumber, 
            'Status'=> -1,
            'UUserID' => $UserData->UserID,
            'UDate'   => $CurrentDateTime
            ],
            );

        if($delete_user){
            return response()-> json([
                'status' => true,
                'msg'    => 'تم الحذف بنجاح',
            ]);
        }//END if($delete_user)
        else{
            return response()-> json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
        }//END else
}//END public function delete_user()

    public function disable_user(Request $request){
        // return $request;
        $UserID = $request->id;
        $find_user = User::where('UserID','=',$UserID)->first();
        $UserData =  $this ->user_data();
        $NewStatus = 1;
        $Status = $find_user->Status;
        if($Status == 1) {
            $NewStatus = -2;
        }//END if($Status == 1)
        else if($Status == -2) {
            $NewStatus = 1;
        }//END else if($Status == 2)
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $delete_user = $update_user_query = DB::table('users')->where('UserID', $UserID)
        ->update(
            [
            'Status'=> $NewStatus,
            'UUserID' => $UserData->UserID,
            'UDate'   => $CurrentDateTime
            ],
            );

        if($delete_user){
            return response()-> json([
                'status' => true,
                'msg'    => 'تم الحذف بنجاح',
            ]);
        }//END if($delete_user)
        else{
            return response()-> json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
        }//END else
    }//END public function disable_user(Request $request)


    public function dashboard() {
        $Services  = Service::where('status','=','1')->count();
        $Courses   = Course::where('status','=','1')->count();
        $Libraries = Libraries::where('status','=','1')->count();
        $AllOrders = CustomOrder::where('status','!=','-1')->count();
        $Offers = CustomOrderOffer::where([['status','!=','-1']])->count();
        $Users     = User::where('status','=','1')->count();
        $Lawyers   = Lawyer::where('status','=','1')->count();
        $Providers = Provider::where('status','=','1')->count();
        $Customers = Customer::where('status','=','1')->count();


        $Counts = array(
            'Services' => $Services,
            'Courses'  => $Courses,
            'Libraries' => $Libraries,
            'AllOrders' => $AllOrders,
            'Offers' => $Offers,
            'Users'     => $Users,
            'Lawyers'   => $Lawyers,
            'Providers' => $Providers,
            'Customers' => $Customers
        );
        return view('users/dashboard',compact('Counts'));
    }//END public function dashboard()

    // public static function users(){

    //  $Users = User::where('status','=','1')->get();
 //     return $Users;
    // }//END public static function users()
}//END class UserController extends Controller
