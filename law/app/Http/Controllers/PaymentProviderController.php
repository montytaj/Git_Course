<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Models\Order;
	use App\Models\Service;
	use App\Models\CustomOrderOffer;
	use Session;

	date_default_timezone_set('Asia/Riyadh');
	use DB;

	class PaymentProviderController extends Controller
	{
		public function payoffer() {
			$OfferID = request('OfferID');
	        $CustomOrderOffers = CustomOrderOffer::with('lawyers')->where([['Status','!=','-1'],['OfferID','=',$OfferID]])->first();
	        if(request('id') and request('resourcePath')) {
				
				 $PaymentStatus = $this->getPaymentStatus(request('id'),request('resourcePath'),request('PaymentType'));
				 $PaymentStatusResponseCode = $PaymentStatus['result']['code'];
			     $PaymentStatusResponseDescription = $PaymentStatus['result']['description'];
				// var_dump($PaymentStatus);
				if(isset($PaymentStatus['id'])) { // SuccessPayment ID -> Transaction Bank ID
					if(request('OrderID')) {
					    date_default_timezone_set('Asia/Riyadh');
						$CurrentDateTime = date('Y-m-d H:i:s', Time());
						$InsertPaymentID = DB::table('orders')->where('OrderID', request('OrderID'))->
		                update([
		                	'PaymentID' => request('id'),
		                	'PaymentTime' => $CurrentDateTime
		            	]);
		            	$UpdateOfferStatus = DB::table('custom_order_offers')->where('OfferID', request('OfferID'))->
		                update([
		                	'Status' => 3,
		            	]);
		            }//END if(request('OrderID'))
		            
					if($PaymentStatusResponseCode == "000.000.000") {
					    $OrderData = Order::where('OrderID','=',request('OrderID'))->first();
    		            $BuyerName = $OrderData['BuyerName'];
    		            $ResiverEmail = $OrderData['BuyerEmail'];
    		            $ServicePrice = $OrderData['CurrentPrice'];
    
    		            $subject = "منصة  لوائح";
    					$txt = "شكراً"." ".$BuyerName." لاختياركم منصة لوائح  \n لقد تم إستلام مبلغ  ".$ServicePrice."  ريال وسيتم التواصل معكم قريباً لتنفيذ الخدمة . \n \n  إدارة منصة لوائح" ;
    					$headers = "From: bylawsco@gmail.com". "\r\n";
    					mail($ResiverEmail,$subject,$txt,$headers);
    					$ShowSuccessPaymentMessage = "تمت عملية الدفع بنجاح";
    					return view("customers/offerdetails",compact('Service'))->with(['ShowSuccessPaymentMessage' => $ShowSuccessPaymentMessage]);
    				}//END $PaymentStatusResponseCode == "000.000.000"
    				else {
    					$DeleteOrder = DB::table('orders')->where('OrderID', request('OrderID'))->
		                delete();
    				     $ShowFailPaymentMessage = "  لم تتم عملية الدفع بنجاح  ";
    					// $ShowFailPaymentMessage = "   لم تتم عملية الدفع بنجاح   ".$PaymentStatusResponseDescription;
    					return view("customers/offerdetails",compact('Service'))->with(['ShowFailPaymentMessage' => $ShowFailPaymentMessage]);
    				}//END else
    				
				}//END if(isset($PaymentStatus['id']))
				else {
					$DeleteOrder = DB::table('orders')->where('OrderID', request('OrderID'))->
		                delete();
					$ShowFailPaymentMessage = "لم تتم عملية الدفع بنجاح ";
					return view("order",compact('Service'))->with(['ShowFailPaymentMessage' => $ShowFailPaymentMessage]);
				}
			}//END if(request('id') && request('resourcePath'))
	        return view('customers/offerdetails',compact('CustomOrderOffers'));
	    }//END public function payoffer($ShowID)	    
		
		public function order($ServiceID) {
			$Service = Service::where('ServiceID','=',$ServiceID)->first();
			session()->put(['ServiceData' => $Service]);
			// $ServiceData = session()->get('ServiceData');
			// return request('id');
			// if(isset($_GET['id']))
			// return $_GET['id'];
			// return $PaymentStatus = $this->getPaymentStatus(request('id'),request('resourcePath'));
			if(request('id') and request('resourcePath')) {
				
				 $PaymentStatus = $this->getPaymentStatus(request('id'),request('resourcePath'),request('PaymentType'));
				 $PaymentStatusResponseCode = $PaymentStatus['result']['code'];
			     $PaymentStatusResponseDescription = $PaymentStatus['result']['description'];
				// var_dump($PaymentStatus);
				if(isset($PaymentStatus['id'])) { // SuccessPayment ID -> Transaction Bank ID
					if(request('OrderID')) {
					    date_default_timezone_set('Asia/Riyadh');
						$CurrentDateTime = date('Y-m-d H:i:s', Time());
						$InsertPaymentID = DB::table('orders')->where('OrderID', request('OrderID'))->
		                update([
		                	'PaymentID' => request('id'),
		                	'PaymentTime' => $CurrentDateTime
		            	]);
		            }//END if(request('OrderID'))
		            
					if($PaymentStatusResponseCode == "000.000.000") {
					    $OrderData = Order::where('OrderID','=',request('OrderID'))->first();
    		            $BuyerName = $OrderData['BuyerName'];
    		            $ResiverEmail = $OrderData['BuyerEmail'];
    		            $ServicePrice = $OrderData['CurrentPrice'];
    
    		            $subject = "منصة  لوائح";
    					$txt = "شكراً"." ".$BuyerName." لاختياركم منصة لوائح  \n لقد تم إستلام مبلغ  ".$ServicePrice."  ريال وسيتم التواصل معكم قريباً لتنفيذ الخدمة . \n \n  إدارة منصة لوائح" ;
    					$headers = "From: bylawsco@gmail.com". "\r\n";
    					mail($ResiverEmail,$subject,$txt,$headers);
    					$ShowSuccessPaymentMessage = "تمت عملية الدفع بنجاح";
    					return view("order",compact('Service'))->with(['ShowSuccessPaymentMessage' => $ShowSuccessPaymentMessage]);
    				}//END $PaymentStatusResponseCode == "000.000.000"
    				else {
    					$DeleteOrder = DB::table('orders')->where('OrderID', request('OrderID'))->
		                delete();
    				     $ShowFailPaymentMessage = "  لم تتم عملية الدفع بنجاح  ";
    					// $ShowFailPaymentMessage = "   لم تتم عملية الدفع بنجاح   ".$PaymentStatusResponseDescription;
    					return view("order",compact('Service'))->with(['ShowFailPaymentMessage' => $ShowFailPaymentMessage]);
    				}//END else
    				
				}//END if(isset($PaymentStatus['id']))
				else {
					$DeleteOrder = DB::table('orders')->where('OrderID', request('OrderID'))->
		                delete();
					$ShowFailPaymentMessage = "لم تتم عملية الدفع بنجاح ";
					return view("order",compact('Service'))->with(['ShowFailPaymentMessage' => $ShowFailPaymentMessage]);
				}
			}//END if(request('id') && request('resourcePath'))
				return view("order",compact('Service'));
		}//END public function order($ServiceID)

	    public function buyservice(Request $request) {
	    	// return $request;
	    	$OfferID = $request->OfferID;
	    	$BuyerNameName = "BuyerName".$OfferID;
	    	$ServicePriceName = "CurrentPrice".$OfferID;
	    	$ServiceIDName = "ServiceID".$OfferID;
	    	$BuyerEmailName = "BuyerEmail".$OfferID;
	    	$PaymentTypeName = "PaymentType".$OfferID;
	    	$ServiceTypeName = "ServiceType".$OfferID;
	    	$BuyerPhoneName =  "BuyerPhone".$OfferID;
	    	$ServicePrice = $request->$ServicePriceName;
	    	$ServiceID = $request->$ServiceIDName;
	    	$BuyerEmail = $request->$BuyerEmailName;
	    	$BuyerName = $request->$BuyerNameName;
	    	$BuyerPhone = $request->$BuyerPhoneName;
	    	$PaymentType = $request->$PaymentTypeName;
	    	$ServiceType = $request->$ServiceTypeName;

	    	date_default_timezone_set('Asia/Riyadh');
	    	$CurrentDateTime = date('Y-m-d H:i:s', Time());
	    	$Insert = Order::create([
	    		"ServiceID" => $ServiceID,
	    		"ServiceType" => $ServiceType,
	            "CurrentPrice" => $ServicePrice,
	    		"BuyerName" => $BuyerName,
	    		"BuyerEmail" => $BuyerEmail,
	    		"BuyerPhone" => $BuyerPhone,
	    		"Status" => 1,
	    		"OrderTime"=> $CurrentDateTime
	    	]);

	    	$OrderID = $Insert->id;
	    // "&currency=SAR"
	    if( $PaymentType == 1) {
	    	$EntityId = "8ac9a4c7833ae750018350070bb40a85";	
	    }//END if( $PaymentType == 1)
	    else if($PaymentType == 2 or $PaymentType ==3 ) {
	    	$EntityId = "8ac9a4c7833ae7500183500681450a7e";
	    }//END else if($PaymentType == 2 or $PaymentType ==3 )
	    $url = "https://oppwa.com/v1/checkouts";
		$data = "entityId=".$EntityId.
	                "&amount=".$ServicePrice.
	                "&currency=SAR" .
	                "&paymentType=DB" .
					"&merchantTransactionId=".$OrderID.
					"&customer.email=".$BuyerEmail.
					"&customer.givenName=".$BuyerName.
					"&customer.surname=".$BuyerName;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                   'Authorization:Bearer OGFjOWE0Yzc4MzNhZTc1MDAxODM1MDA1ZGQ2MjBhNzl8WE04SkM0WjJEcg=='));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$ResponseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);

		$ResponseData = json_decode($ResponseData, true);

		$view = view('ajax.form')->with(['ResponseData' => $ResponseData,'ServiceID' => $ServiceID,'OrderID' => $OrderID, 'PaymentType' => $PaymentType,'ServiceType'=>$ServiceType ])->renderSections();

		return response()->json([
	                'status' => true,
	                'content'    => $view['Payment'],
	            ]);

		// var_dump($ResponseData);
		// echo "<br>";
		// $checkoutId = $ResponseData['id'];
	    }//END public function buyservice(Request $request)

	    public function buy_custom_service(Request $request) {
	    	// return $request;
	    	$ServicePrice = $request->CurrentPrice;
	    	$ServiceID = $request->ServiceID;
	    	$BuyerEmail = $request->BuyerEmail;
	    	$BuyerName = $request->BuyerName;
	    	$PaymentType = $request->PaymentType;
	    	date_default_timezone_set('Asia/Riyadh');
	    	$CurrentDateTime = date('Y-m-d H:i:s', Time());
	    	$Insert = Order::create([
	    		"ServiceID" => $ServiceID,
	            "CurrentPrice" => $ServicePrice,
	    		"BuyerName" => $request->BuyerName,
	    		"BuyerEmail" => $request->BuyerEmail,
	    		"BuyerPhone" => $request->BuyerPhone,
	    		"Status" => 1,
	    		"OrderTime"=> $CurrentDateTime
	    	]);

	    	$OrderID = $Insert->id;
	    // "&currency=SAR"
	    if( $PaymentType == 1) {
	    	$EntityId = "8ac9a4c7833ae750018350070bb40a85";	
	    }//END if( $PaymentType == 1)
	    else if($PaymentType == 2 or $PaymentType ==3 ) {
	    	$EntityId = "8ac9a4c7833ae7500183500681450a7e";
	    }//END else if($PaymentType == 2 or $PaymentType ==3 )
	    $url = "https://oppwa.com/v1/checkouts";
		$data = "entityId=".$EntityId.
	                "&amount=".$ServicePrice.
	                "&currency=SAR" .
	                "&paymentType=DB" .
					"&merchantTransactionId=".$OrderID.
					"&customer.email=".$BuyerEmail.
					"&customer.givenName=".$BuyerName.
					"&customer.surname=".$BuyerName;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	                   'Authorization:Bearer OGFjOWE0Yzc4MzNhZTc1MDAxODM1MDA1ZGQ2MjBhNzl8WE04SkM0WjJEcg=='));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$ResponseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);

		$ResponseData = json_decode($ResponseData, true);

		$view = view('ajax.form')->with(['ResponseData' => $ResponseData,'ServiceID' => $ServiceID,'OrderID' => $OrderID, 'PaymentType' => $PaymentType ])->renderSections();

		return response()->json([
	                'status' => true,
	                'content'    => $view['Payment'],
	            ]);


	    }//END public function buy_custom_service(Request $request)

	    private function getPaymentStatus($ID,$resourcePath,$PaymentType) {
		   	if( $PaymentType == 1) {
		    	$EntityId = "8ac9a4c7833ae750018350070bb40a85";	
		    }//END if( $PaymentType == 1)
		    else if($PaymentType == 2 or $PaymentType ==3 ) {
		    	$EntityId = "8ac9a4c7833ae7500183500681450a7e";
		    }//END else if($PaymentType == 2 or $PaymentType ==3 )
	    	$url = "https://oppwa.com/";
			$url .= $resourcePath; 
			$url .= "?entityId=".$EntityId;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		                   'Authorization:Bearer OGFjOWE0Yzc4MzNhZTc1MDAxODM1MDA1ZGQ2MjBhNzl8WE04SkM0WjJEcg=='));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);// this should be set to true in production
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$ResponseData = curl_exec($ch);
			if(curl_errno($ch)) {
				return curl_error($ch);
			}
			curl_close($ch);
			return json_decode($ResponseData,true);

	    }//END private function getPaymentStatus($ID,$ResourcePath)


	}
