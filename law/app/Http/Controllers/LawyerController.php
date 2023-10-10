<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Lawyer;
use App\Models\City;
use App\Models\Field;
use App\Models\Qualification;
use App\Models\Service;
use App\Models\Course;
use App\Models\Libraries;
use App\Models\CustomOrder;
use App\Models\CustomOrderOffer;
use App\Models\Setting;
use App\Models\Customer;

use Carbon\Carbon;
use DB;
use Session;


class LawyerController extends Controller
{
    public function lawyer_data(){
        $LawyerData = session()->get('LawyerData');
        return $LawyerData;
    }//END public function lawyer_data()
	public function index() {
		$Cities = City::where('Status','=','1')->get();
        $Fields = Field::where('Status','=','1')->get();
        $Qualifications = Qualification::where('Status','=','1')->get();
        // $Services = Service::where('Status','=','1')->get();
        $Services = Service::where('Status','=','1')->OrderBy('ServiceID','Desc')->take(16)->get();
        $CurrentDate = date('Y-m-d');
        $Courses = Course::where([['Status','=','1'],['CourseDate','>=',$CurrentDate]])->OrderBy('CourseID','Desc')->take(3)->get();
        $Libraries = Libraries::with('fields')->where([['Status','=',1],['FromDate','<=',$CurrentDate],['ToDate','>=',$CurrentDate]])
        ->OrderBy('SubjectID','Desc')->take(3)->get();
		return view('index',compact('Cities','Fields','Qualifications','Services','Courses','Libraries'));
	}//END public function index()

    public function terms_and_conditions() {
        return view('terms_and_conditions');
    }//END public function terms_and_conditions()

    public function add_lawyer(Request $request) {
    	// return $request;
    	$CurrentDateTime = date('Y-m-d h:i:s', Time());
    	$file_path = "";
    	$CheckFile = $request['LicensePath'];
	    if(is_null($CheckFile)) {
	        $file_path = "";
	    }//END if(is_null($CheckFile))
	    else {
	        $file_name =   $this -> saveImage($request['LicensePath'],'assets/images/lawyer');
	        $file_path = "assets/images/lawyer/".$file_name;
	    }//END else //if(is_null($CheckFile))
    	$Insert = Lawyer::create([
    		'FirstName' =>$request->FirstName,
    		'LastName'  =>$request->LastName,
            'AccountID' =>$request->LawyerAccountID,
    		'QualificationID' =>$request->QualificationID,
    		'Specialism' =>$request->Specialism,
    		'LicenseType' =>$request->LicenseType,
    		'LicensePath' =>$file_path,
    		'Experience' =>$request->Experience,
    		'CityID' => -1,
    		'PhoneNumber' =>$request->PhoneNumber,
    		'Email'	=>$request->Email,
    		'Password' =>bcrypt($request->Password) ,
    		'FieldID' =>$request->FieldID,
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

    }//END public function add_lawyer(Request $request)

    public function lawyer_login_form(){
        return view('lawyers/login');
    }//END public function lawyer_login_form()
    public function lawyer_login(Request $request) {
        // return $request;
        $user_name = $request->user_name;
        $user_password = $request->user_password;
        $LawyerData = Lawyer::
        where([['Email','=',$user_name],['status','=','1']])
        ->orwhere([['PhoneNumber','=',$user_name],['status','=','1']])
        ->first();
        // return $LawyerData;
        if(!empty($LawyerData)) {
            // return $LawyerData;
            $check_user_password = Hash::check($user_password, $LawyerData->Password);
        }//end if(!empty($LawyerData))
        // return $check_user_password;
        if(!empty($LawyerData) and $check_user_password) {
            $LawyerID = $LawyerData->LawyerID;
            session()->put(['LawyerData' => $LawyerData]);
            $LawyerData = session()->get('LawyerData');
            // return $LawyerData;
            if(!empty($LawyerData)) {
                return response()->json([
                'url'=>url('/lawyers/dashboard'),
                'status' => true,
                ]);
            }// END if(!empty($user_data))
            else{
                return response()->json([
                'status' => false,
                    ]);
            }//END else
        }// END if(!empty($LawyerData) and $check_user_password)
        else{
            return response()->json([
            'status' => false,
            ]);
        }//END else
    }//END public function lawyer_login(Request $request)


    public static function count_active_orders(){
        $LawyerData = session()->get('LawyerData');
        // $LawyerData =  $this ->lawyer_data();
        // return $LawyerData;
        $AountActiveOrders = CustomOrder::where('Status','=','1')->Orwhere('Status','=','1')->count();
        return $AountActiveOrders;
    }//END public static function count_active_orders()
    public function active_orders(){
        $LawyerData = session()->get('LawyerData');
        // return $LawyerData;
        $ActiveCustomOrders = CustomOrder::with('fields','customers')->where('Status','!=','-1')->Orwhere('Status','=','1')->get();
        return view('lawyers/activecustomorders',compact('ActiveCustomOrders'));
    }//END public static function active_orders()
    public function newoffer($ShowID) {
        $LawyerData = $this->lawyer_data();
        $LawyerID = $LawyerData->LawyerID;
        $CustomOrder = CustomOrder::with('fields','cities','customers','offers')->where([['Status','!=','-1'],['CustomOrderID','=',$ShowID]])->first();
        $CustomOrderLawyer = CustomOrderOffer::where([['Status','!=','-1'],['CustomOrderID','=',$ShowID],['LawyerID','=',$LawyerID]])->first();
        // $Price =  $CustomOrderLawyer->Price;
        
        $LessPriceOffer = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['CustomOrderID','=',$ShowID]])->OrderBy('price')->first();
        // if(empty($LessPriceOffer))
        $LessTimeOffer = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['CustomOrderID','=',$ShowID]])->OrderBy('Execution_Period')->first();
        $CustomOrderOffers = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['CustomOrderID','=',$ShowID]])->get();
        $Settings = Setting::where([['Status','=','1']])->first();
        return view('lawyers/newoffer',compact('CustomOrder','Settings','CustomOrderOffers','LawyerID','CustomOrderLawyer','LessPriceOffer','LessTimeOffer'));
    }//END public function newoffer()
    public function add_new_offer(Request $request) {
        // return $request;
        $LawyerData = $this->lawyer_data();
        $Settings = Setting::where([['Status','=','1']])->first();
        $PlatformCommission = $Settings->PlatformCommission;
        $Tax = $Settings->Tax;
        $Price = $request->Price;
        $TaxAmount = ($Price * $Tax) / 100 ;
        $TotalAmount = ($Price + $TaxAmount);
        date_default_timezone_set('Asia/Riyadh');
        $CurrentDateTime = date('Y-m-d h:i:s', Time());
        $CurrentDate = date('Y-m-d');
        $CurrentTime = date('h:i:s', Time());
        try {
            $Insert = CustomOrderOffer::create([
                'CustomOrderID' =>$request->CustomOrderID,
                'CustomerID'=>$request->CustomerID,
                'LawyerID'  =>$LawyerData->LawyerID,
                'LawyerType' =>1,
                'Description' =>$request->Description,
                'Execution_Period' => $request->Execution_Period,
                'Price' =>$request->Price,
                'Tax' =>$Tax,
                'PlatformCommission' =>$PlatformCommission,
                'TotalAmount' =>$TotalAmount,
                'Status' =>2,
                'OfferDate' =>$CurrentDate,
                'OfferTime' => $CurrentTime,
                'OfferDateTime' => $CurrentDateTime
            ]);
            $CustomerID = $request->CustomerID;
            $Customer = Customer::where([['CustomerID','=',$CustomerID]])->first();
            $ResiverEmail =  $Customer->Email;
            $subject = " تم تقديم عرض جديد على طلبك على منصة لوائح ";
            $txt = $request->Description;
            $headers = "From: bylawsco@gmail.com". "\r\n";
            mail($ResiverEmail,$subject,$txt,$headers);
        

            $NewID = $Insert->id;
            if ($Insert and $NewID > 0) {
                return response()->json([
                    'status' => true,
                ]);
            } //END
            else {
                return response()->json([
                    'status' => false,
                ]);
            }
        }//END try
        catch (\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            // if($errorCode == '1062'){
            //    return back()->with('error', 'Your message may be a duplicate. Did you refresh the page? We blocked that submission. If you feel this was in error, e-mail us or call us.');
            // }
            return response()->json([
                    'status' => false,
                    'errorCode' => $errorCode,
                ]);
        }//END catch
    }//END public function add_new_offer(Request $request)
    
    public function update_offer(Request $request) {
        // return $request;
        date_default_timezone_set('Asia/Riyadh');
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $UpdateID = $request->UpdateID;
        $Settings = Setting::where([['Status','=','1']])->first();
        $PlatformCommission = $Settings->PlatformCommission;
        $Tax = $Settings->Tax;
        $Price = $request->Price;
        $TaxAmount = ($Price * $Tax) / 100 ;
        $TotalAmount = ($Price + $TaxAmount);
        $Execution_Period = $request->Execution_Period;
        $UpdateQuery = DB::table('custom_order_offers')->where('OfferID','=',$UpdateID)->
                        update([
                            'Price' =>$request->Price,
                            'Description' =>$request->Description,
                            'PlatformCommission' =>$PlatformCommission,
                            'TotalAmount' =>$TotalAmount,
                            'Execution_Period' => $Execution_Period,
                            'LawyerUpdateDate' =>$CurrentDateTime
                        ]);
        // return $UpdateQuery;
        if ($UpdateQuery) {
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
    }//END public function update_offer(Request $request)
    public function delete_offer(Request $request) {

    }//END public function delete_offer(Request $request)


    public function dashboard() {
        // $ActiveOrders =  $this ->active_orders();
        $LawyerData = $this->lawyer_data();
        $LawyerID = $LawyerData->LawyerID;
        $CountCustomOrderOffers = 0;
        $CountDoneCustomOrderOffers = 0;
        $CountCustomOrders = CustomOrder::where([['Status','!=','-1']])->count();
        $CountCustomOrderOffers = CustomOrderOffer::where([['Status','!=','-1'],['LawyerID','=',$LawyerID]])->count();
        $CountDoneCustomOrderOffers = CustomOrderOffer::where([['Status','=','3'],['LawyerID','=',$LawyerID]])->count();
        $TotalAmount = CustomOrderOffer::where([['Status','=','3'],['LawyerID','=',$LawyerID]])->sum('Price');
        // return $CountCustomOrderOffers;
        // return $SumCountCustomOrderOffers;
        $Counts = array(
            'CountCustomOrderOffers' => $CountCustomOrderOffers,
            'CountDoneCustomOrderOffers'  => $CountDoneCustomOrderOffers,
            'CountCustomOrders' => $CountCustomOrders,
            'TotalAmount' => $TotalAmount,
        );
        // return $Counts;
        return view('lawyers/dashboard',compact('Counts'));
    }//END public function dashboard()

    public function lawyer_offers() {
        $LawyerData = $this->lawyer_data();
        $LawyerID = $LawyerData->LawyerID;
        $LawyerOffers = CustomOrderOffer::with('customers','lawyers')->where([['Status','!=','-1'],['LawyerID','=',$LawyerID]])->get();
        // $CountDoneCustomOrderOffers = CustomOrderOffer::where([['Status','=','3'],['LawyerID','=',$LawyerID]])->count();
        return view('lawyers/lawyer_offers',compact('LawyerOffers'));
    }//END public function lawyer_offers()
    public function lawyer_done_offers() {
        $LawyerData = $this->lawyer_data();
        $LawyerID = $LawyerData->LawyerID;
        $LawyerOffers = CustomOrderOffer::with('customers','lawyers')->where([['Status','=','3'],['LawyerID','=',$LawyerID]])->get();
        return view('lawyers/lawyer_done_offers',compact('LawyerOffers'));
    }//END public function lawyer_done_offers()



    public function logout() {
        session()->forget('LawyerData');
        return redirect('lawyer_login_form');
    }//END public function logout()


	protected function saveImage($photo,$folder){
	    $file_extention = $photo ->getClientOriginalExtension();
	    $file_name = time().'.'.$file_extention;
	    $path = $folder;
	    $photo->move($path,$file_name);
	    return $file_name;
}//END protected function saveImage($photo,$folder)


}
