<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\City;
use App\Models\Field;
use App\Models\Qualification;
use App\Models\Customer;
use App\Models\CustomOrder;
use App\Models\CustomOrderOffer;
use App\Models\Service;
use App\Models\Lawyer;

use Carbon\Carbon;
use DB;
use Session;

class CustomerController extends Controller
{
    public function customer_data(){
        $CustomerData = session()->get('CustomerData');
        return $CustomerData;
    }//END public function customer_data()
    public function index() {
		$Cities = City::where('Status','=','1')->get();
        $Fields = Field::where('Status','=','1')->get();
        $Qualifications = Qualification::where('Status','=','1')->get();

		return view('index',compact('Cities','Fields','Qualifications'));
	}//END public function index()

	public function add_customer(Request $request) {
    	// return $request;
    	$CurrentDateTime = date('Y-m-d h:i:s', Time());
    	$Insert = Customer::create([
    		'FirstName' =>$request->CustomerFirstName,
    		'LastName' =>$request->CustomerLastName,
    		'CityID' => -1,
    		'PhoneNumber' =>$request->CustomerPhoneNumber,
    		'Email'	=>$request->CustomerEmail,
    		'Password' =>bcrypt($request->CustomerPassword) ,
    		'Status' =>1,
    		'CDate' =>$CurrentDateTime
    	]);

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

    }//END public function add_customer(Request $request)


    public function customer_login_form(){
        return view('customers/login');
    }//END public function customer_login_form()
    public function customer_login(Request $request) {
        // return $request;
        $user_name = $request->user_name;
        $user_password = $request->user_password;
        $CustomerData = Customer::
        where([['Email','=',$user_name],['status','=','1']])
        ->orwhere([['PhoneNumber','=',$user_name],['status','=','1']])
        ->first();
        // return $CustomerData;
        if(!empty($CustomerData)) {
            $check_user_password = Hash::check($user_password, $CustomerData->Password);
        }//end if(!empty($user))
        if(!empty($CustomerData) and $check_user_password) {
            // $UserID = $UserData->UserID;
            session()->put(['CustomerData' => $CustomerData]);
            $CustomerData = session()->get('CustomerData');
            // return $user_data;
            if(!empty($CustomerData)) {
                return response()->json([
                'url'=>url('/customers/dashboard'),
                'status' => true,
                ]);
            }// END if(!empty($user_data))
        else{
            return response()->json([
            'status' => false,
                ]);
        }//END else
        }// END if(!empty($CustomerData) and $check_user_password)
        else{
            return response()->json([
            'status' => false,
            ]);
        }//END else
    }//END public function customer_login(Request $request)

    public function custome_order($ServiceID) {
        // return $ServiceID;
        $ServiceData = "";
        if($ServiceID != 0) {
            $ServiceData = Service::where('ServiceID','=',$ServiceID)->first();
        }//END if($ServiceID != 0)
        $Cities = City::where('Status','=','1')->get();
        $Fields = Field::where('Status','=','1')->get();
        return view('customers/custome_order',compact('ServiceData','Fields','Cities'));
    }//END public function custome_order()

    public function add_custom_order(Request $request) {
        date_default_timezone_set('Asia/Riyadh');
        $CurrentDate = date('Y-m-d');
        $CurrentTime = date('H:i:s', Time());
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $CustomerData =  $this ->customer_data();
        $Insert = CustomOrder::create([
            'CustomerID' =>$CustomerData->CustomerID,
            'FieldID' =>$request->FieldID,
            'CityID' => 0,
            'Description' =>$request->OrderDescription,
            'Status' =>1,
            'OrderDate' =>$CurrentDate,
            'OrderTime' =>$CurrentTime,
            'OrderDateTime' =>$CurrentDateTime
        ]);

        $Lawyers = Lawyer::where([['Status','!=','-1']])->get();
        foreach ($Lawyers as $Lawyer) {
            // $LawyerEmail = $Lawyer->Email;
            $ResiverEmail =  $Lawyer->Email;
            $subject = " طلب خدمة جديدة على منصة لوائح ";
            $txt = $request->OrderDescription;
            $headers = "From: bylawsco@gmail.com". "\r\n";
            mail($ResiverEmail,$subject,$txt,$headers);
        }//END foreach ($Lawyers as $Lawyer)

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
    }//END public function add_custom_order(Request $request)

    public function customer_custome_orders() {
        $CustomerData =  $this ->customer_data();
        $CustomerID = $CustomerData->CustomerID;
        $CustomOrders = CustomOrder::with('cities','fields','offers')->where([['CustomerID','=',$CustomerID],['Status','!=','-1']])->get();
        // return $CustomOrders;
        return view('customers/customer_custome_orders',compact('CustomOrders'));
    }//END public function customer_custome_orders()

    public function show_customer_custome_order($ShowID) {
        $CustomerData =  $this ->customer_data();
        $CustomerID = $CustomerData->CustomerID;
        $Cities = City::where('Status','=','1')->get();
        $Fields = Field::where('Status','=','1')->get();
        $CustomOrder = CustomOrder::with('cities','fields')->where([['CustomOrderID','=',$ShowID],['CustomerID','=',$CustomerID],['Status','!=','-1']])->first();
        $CustomOrderOffers = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['CustomOrderID','=',$ShowID]])->get();
        return view('customers/show_customer_custome_order',compact('Fields','Cities','CustomOrder','CustomOrderOffers'));
    }//END public function show_customer_custome_order($ShowID)

    public function update_customer_custome_order(Request $request) {
        // return $request;
        date_default_timezone_set('Asia/Riyadh');
        $CurrentDate = date('Y-m-d');
        $CurrentTime = date('H:i:s', Time());
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $CustomerData =  $this ->customer_data();
        $CustomOrderID = $request->UpdateID;
        // $CustomOrderID = 0;
        $UpdateQuery = DB::table('custom_orders')->where('CustomOrderID','=',$CustomOrderID)->
                        update([
                            'FieldID' =>$request->FieldID,
                            'CityID' =>$request->CityID,
                            'Description' =>$request->OrderDescription,
                            'CustomerUpdateDate' =>$CurrentDateTime,
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
    }//END public function update_customer_custome_order(Request $request)

    public function delete_customer_custome_order($CustomOrderID) {
        // return $request;
        date_default_timezone_set('Asia/Riyadh');
        $CurrentDate = date('Y-m-d');
        $CurrentTime = date('H:i:s', Time());
        $CurrentDateTime = date('Y-m-d H:i:s', Time());
        $CustomerData =  $this ->customer_data();
        $UpdateQuery = DB::table('custom_orders')->where('CustomOrderID','=',$CustomOrderID)->
                        update([
                            'Status' =>-1,
                            'CustomerDeleteDate' =>$CurrentDateTime,
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
    }//END public function delete_customer_custome_order(Request $request)

    public function show_customer_offer_details($ShowID) {
        $CustomOrderOffers = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['OfferID','=',$ShowID]])->first();
        // return $CustomOrderOffers; 
        return view('customers/offerdetails',compact('CustomOrderOffers'));
    }//END public function show_customer_offer_details($ShowID)

    public function custom_order_offers() {
        $CustomerData =  $this ->customer_data();
        $CustomerID = $CustomerData->CustomerID;
        $CustomOrderOffers = CustomOrderOffer::where([['Status','!=','-1'],['CustomerID','=',$CustomerID]])->get();
        return view('customers/custom_order_offers',compact('CustomOrderOffers'));
    }//END public function custom_order_offers()
    public function custom_done_order_offers() {
        $CustomerData =  $this ->customer_data();
        $CustomerID = $CustomerData->CustomerID;
        $DoneCustomOrderOffers = CustomOrderOffer::where([['Status','=','3'],['CustomerID','=',$CustomerID]])->get();
        return view('customers/custom_done_order_offers',compact('DoneCustomOrderOffers'));
    }//END public function custom_done_order_offers()


    public function dashboard() {
        $CustomerData =  $this ->customer_data();
        $CustomerID = $CustomerData->CustomerID;
        $CountCustomOrderOffers = 0;
        $CountDoneCustomOrderOffers = 0;
        $CountCustomOrders = CustomOrder::where([['Status','!=','-1'],['CustomerID','=',$CustomerID]])->count();
            $CountCustomOrderOffers = CustomOrderOffer::where([['Status','!=','-1'],['CustomerID','=',$CustomerID]])->count();
            $CountDoneCustomOrderOffers = CustomOrderOffer::where([['Status','=','3'],['CustomerID','=',$CustomerID]])->count();
        // return $CountCustomOrderOffers;
        // return $SumCountCustomOrderOffers;
        $Counts = array(
            'CountCustomOrderOffers' => $CountCustomOrderOffers,
            'CountDoneCustomOrderOffers'  => $CountDoneCustomOrderOffers,
            'CountCustomOrders' => $CountCustomOrders,
        );

        // return $Counts;
        return view('customers/dashboard',compact('Counts'));
    }//END public function dashboard()


    public function logout() {
        session()->forget('CustomerData');
        return redirect('lawyer_login_form');
    }//END public function logout()


}//END class CustomerController extends Controller
