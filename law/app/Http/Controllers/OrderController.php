<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Service;
use App\Models\Course;
use App\Models\Libraries;
use App\Models\CustomOrder;
use App\Models\CustomOrderOffer;

use DB;

class OrderController extends Controller
{
	public function user_data(){
        $UserData = session()->get('UserData');
        return $UserData;
    }//END public function user_data()

	public function order($ServiceID) {
		$Service = Service::where('ServiceID','=',$ServiceID)->first();
		return view("order",compact('Service'));
	}//END public function order($ServiceID)
    public function buyservice(Request $request) {
    	// return $request;
    	$CurrentDateTime = date('Y-m-d H:i:s', Time());
    	$Insert = Order::create([
    		"ServiceID" => $request->ServiceID,
            "CurrentPrice" => $request->CurrentPrice,
    		"BuyerName" => $request->BuyerName,
    		"BuyerEmail" => $request->BuyerEmail,
    		"BuyerPhone" => $request->BuyerPhone,
    		"Status" => 1,
    		"OrderTime"=> $CurrentDateTime
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
    }//END public function buyservice(Request $request)

    public function show_orders() {
    	$Orders = CustomOrder::with('offers','customers','fields')->where('Status','!=','-1')->get();
    	// return $Orders;
        return view('layout.admin.orders',compact('Orders'));
    }//END public function show_orders()

    public function show_offers() {
        $Orders = CustomOrder::with('offers','customers')->where('Status','!=','-1')->get();
        // return $Orders;
        return view('layout.admin.show_offers',compact('Orders'));
    }//END public function show_offers()
    public function show_offer($OrderID) {
        $Offers = CustomOrderOffer::with('customers','lawyers','orders')->where('Status','!=','-1')->get();
        // return $Offers;
        return view('layout.admin.show_order_offers',compact('Offers'));
    }//END public function show_offer($OrderID)
    

    public function orders_report() {
        return view('admin.orders_report');
    }//END public function orders_report()
    public function orders_report_result(Request $request) {
        //return $request;
        $FromDate = $request->FromDate;
        $ToDate   = $request->ToDate;
        $Status   = $request->Status;
        if(!empty($FromDate) and !empty($ToDate) and $Status != -1) {
            $Report = Order::where([['OrderTime','>=',$FromDate],['OrderTime','<=',$ToDate],['Status','=',$Status]])->get();
        }//END if(!empty($FromDate) and !empty($ToDate) and $Status != -1)
        else if(!empty($FromDate) and !empty($ToDate) and $Status == -1) {
            $Report = Order::where('Status','!=',-1)->get();
        }//END else if(!empty($FromDate) and !empty($ToDate) and $Status == -1)
        else if(empty($FromDate) and empty($ToDate) and $Status == -1) {
            $Report = Order::where([['OrderTime','>=',$FromDate],['OrderTime','<=',$ToDate],['Status','!=',-1]])->get();
        }//END if(empty($FromDate) and empty($ToDate) and $Status == -1)

        return $Report;
    }//END public function orders_report_result(Request $request) 

    public function change_orders($OrderID) {
        //return $Order = DB::table('orders')->where('OrderID', $OrderID)->get();
        $Order = Order::where('OrderID','=',$OrderID)->first();
        $CurrentStatus = $Order['Status'];
        $CurrentDateTime = date('Y-m-d h:i:s', Time());
        $UserData =  $this ->user_data();
        //return $CurrentStatus;
        if($CurrentStatus == 1) {
            $Status = 2;
            $Update =  DB::table('orders')->where('OrderID', $OrderID)->
                update([
                'Status' => $Status,
                'UserResever' =>$UserData->UserID,
                'ReseverTime' => $CurrentDateTime
            ]);
        }//END if($CurrentStatus == 1)
        else if($CurrentStatus == 2) {
            $Status = 3;
            $Update =  DB::table('orders')->where('OrderID', $OrderID)->
                update([
                'Status' => $Status,
                'UserDone' =>$UserData->UserID,
                'DoneTime' => $CurrentDateTime
            ]);
        }//END else if($CurrentStatus == 2)
        else if($CurrentStatus == 3) {
            $Status = -1;
            $Update =  DB::table('orders')->where('OrderID', $OrderID)->
                update([
                'Status' => $Status,
                'UserDone' =>$UserData->UserID,
                'DoneTime' => $CurrentDateTime
            ]);
        }//END else if($CurrentStatus == 3)

        return redirect()->back()->with('message', 'تمت  العملية بنجاح');
    }//END public function change_orders($OrderID)

    public function services() {
        $Services = Service::where('Status','=','1')->OrderBy('ServiceID','Desc')->get();
        return view('services',compact('Services'));
    }//END public function services()

    public function courses() {
        $CurrentDate = date('Y-m-d');
        $Courses = Course::where([['Status','=','1'],['CourseDate','>=',$CurrentDate]])->OrderBy('CourseID','Desc')->get();
        // $Courses = Course::where('Status','=','1')->OrderBy('CourseID','Desc')->get();
        return view('courses',compact('Courses'));
    }//END public function courses()

    public function libraries() {
        $CurrentDate = date('Y-m-d');
        $Libraries = Libraries::with('fields','documents')->where([['Status','=',1],['FromDate','<=',$CurrentDate],['ToDate','>=',$CurrentDate]])
        ->OrderBy('SubjectID','Desc')->get();
        return view('libraries',compact('Libraries'));
    }//END public function libraries()
    
}//END class OrderController extends Controller
