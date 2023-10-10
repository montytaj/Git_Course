<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\Field;
use App\Models\Qualification;
use App\Models\Provider;

use Carbon\Carbon;
use DB;
use Session;

class ProviderController extends Controller
{
    public function index() {
		$Cities = City::where('Status','=','1')->get();
        $Fields = Field::where('Status','=','1')->get();
        $Qualifications = Qualification::where('Status','=','1')->get();

		return view('index',compact('Cities','Fields','Qualifications'));
	}//END public function index()

	public function add_provider(Request $request) {
    	// return $request;
    	$CurrentDateTime = date('Y-m-d h:i:s', Time());
    	$file_path = "";
    	$CheckFile = $request['LicensePath'];
	    if(is_null($CheckFile)) {
	        $file_path = "";
	    }//END if(is_null($CheckFile))
	    else {
	        $file_name =   $this -> saveImage($request['LicensePath'],'assets/images/providers');
	        $file_path = "assets/images/providers/".$file_name;
	    }//END else //if(is_null($CheckFile))
    	$Insert = Provider::create([
    		'ProviderName' =>$request->ProviderName,
    		'ProviderType' =>$request->ProviderType,
    		'Address' =>$request->Address,
    		'LicensePath' =>$file_path,
    		'CityID' =>$request->ProviderCityID,
    		'PhoneNumber' =>$request->ProviderPhoneNumber,
    		'Email'	=>$request->ProviderEmail,
            'AccountID' =>$request->ProviderAccountID,
    		'Password' =>bcrypt($request->ProviderPassword),
    		'Status' =>1,
    		'CDate' =>$CurrentDateTime
    	]);

    	if ($Insert) {
            return response()->json([
                'status' => true,
                'msg'    => 'Success Of Add New Offer',
            ]);
        } //END
        else {
            return response()->json([
                'status' => false,
                'msg'    => 'Faild Of Add New Offer',
            ]);
        }

    }//END public function add_provider(Request $request)

    public function provider_login_form(){
        // return "Monty";
        return view('providers/login');
    }//END public function provider_login_form()
    public function provider_login(Request $request) {
        // return $request;
        $user_name = $request->user_name;
        $user_password = $request->user_password;
        $ProviderData = Provider::
        where([['Email','=',$user_name],['status','=','1']])
        ->orwhere([['PhoneNumber','=',$user_name],['status','=','1']])
        ->first();
        // return $ProviderData;
        if(!empty($ProviderData)) {
            $check_user_password = Hash::check($user_password, $ProviderData->Password);
        }//end if(!empty($ProviderData))
        if(!empty($ProviderData) and $check_user_password) {
            // $UserID = $UserData->UserID;
            session()->put(['ProviderData' => $ProviderData]);
            $ProviderData = session()->get('ProviderData');
            // return $ProviderData;
            if(!empty($ProviderData)) {
                return response()->json([
                'url'=>url('/providers/dashboard'),
                'status' => true,
                ]);
            }// END if(!empty($user_data))
        else{
            return response()->json([
            'status' => false,
                ]);
        }//END else
        }// END if(!empty($ProviderData) and $check_user_password)
        else{
            return response()->json([
            'status' => false,
            ]);
        }//END else
    }//END public function provider_login(Request $request)

    public function dashboard() {
        return view('providers/dashboard');
    }//END public function dashboard()

    public function logout() {
        session()->forget('LawyerData');
        return redirect('provider_login_form');
    }//END public function logout()


	protected function saveImage($photo,$folder){
	    $file_extention = $photo ->getClientOriginalExtension();
	    $file_name = time().'.'.$file_extention;
	    $path = $folder;
	    $photo->move($path,$file_name);
	    return $file_name;
}//END protected function saveImage($photo,$folder)

}//END class ProviderController extends Controller
