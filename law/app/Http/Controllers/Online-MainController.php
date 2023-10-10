<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Libraries;
use App\Models\Field;
use App\Models\LegislationDocument;
use App\Models\Service;
use App\Models\Course;
use App\Models\Lawyer;
use App\Models\Provider;
use App\Models\Customer;

use DB;


class MainController extends Controller
{
	public function user_data(){
        $UserData = session()->get('UserData');
        return $UserData;
    }//END public function user_data()

	#############################################################################################
	####################################### POSTS ###############################################
	#############################################################################################
	public function posts() {
		$Fields = Field::where('Status','=','1')->get();
		$Libraries = Libraries::with('documents')->where('Status','=','1')->get();
		// return $Libraries;
		return view('admin.add_post',compact('Fields','Libraries'));
	}//END public function posts()
	public function add_post(Request $request) {
		// return $request;
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$InsertSubject = Libraries::create([
			"Content" => $request->Content,
			"Title" => $request->Title,
			"SubjectType" => $request->SubjectType,
			"Author" => $request->Author,
			"FieldID" => $request->FieldID,
			"FromDate" => $request->FromDate,
			"ToDate" => $request->ToDate,
			'Status' =>1,
			'CUserID' =>$UserData->UserID,
			'CDate' =>$CurrentDateTime
		]);
		$SubjectID = $InsertSubject->id;

        $Counter = 0;
        $InsertLegislationDocument = 0 ;

        $CheckFile = $request['Documents'];
	    // return $CheckFile;
	    if(!is_null($CheckFile)) {
	   		foreach ($request->Documents as $value) {
	            $Counter = $Counter+1;
		         $FileName =        $this -> saveImage($value,'public/assets/images/legislation',$Counter);
		         $FullPath = "public/assets/images/legislation/".$FileName;
		         
		         $InsertLegislationDocument = LegislationDocument::create([
	            	'SubjectID' => $SubjectID ,
	            	'LegislationDocumentPath' => $FullPath ,
	        	]);

	           if($InsertLegislationDocument){
	            	$InsertLegislationDocument = 1;
	           }// END if($insert_product_images)
	        }//END foreach ($request->photo_path as $value)
	    }//END if(is_null($CheckFile))
	    else {
	    	// return "EMMMMMMMMMMMMMMMMMPTY";
	    }

	    if($InsertSubject){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }

	}//END public function add_posts(Request $request)   

	public function post($SubjectID) {
		$Post = Libraries::where('SubjectID','=',$SubjectID)->first();
		// return $Post;
		$Fields = Field::where('Status','=','1')->get();
		return view('admin.post',compact('Post','Fields'));
	}//END public function post($SubjectID)

	public function update_post(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$SubjectID =  $request->SubjectID;
		$Update =  DB::table('library')->where('SubjectID', $SubjectID)->
			update([
			'Content' => $request->Content,
			'Title' => $request->Title,
			'SubjectType' => $request->SubjectType,
			'Author' => $request->Author,
			'FieldID' => $request->FieldID,
			'FromDate' => $request->FromDate,
			'ToDate' => $request->ToDate,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }

	}//END public function update_post(Request $Request)

	public function delete_post(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$SubjectID =  $request->SubjectID;
		$Update =  DB::table('library')->where('SubjectID', $SubjectID)->
			update([
			'Status' => -1,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_post(Request $Request)

	#############################################################################################
	####################################### SERVICES ############################################
	#############################################################################################
	public function services() {
		$Services = Service::where('Status','=','1')->get();
		return view('admin.services',compact('Services'));
	}//END public function posts()

	public function add_service(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$FileName =        $this -> saveImage($request->ServiceImage,base_path().'/../public_html/public/assets/images/services',1);
		$ServiceImagePath = "public/assets/images/services/".$FileName;
		$Insert = Service::create([
			"ServiceName" => $request->ServiceName,
			"ServiceType" => $request->ServiceType,
			"ServiceDetails" => $request->ServiceDetails,
			"ServicePrice" => $request->ServicePrice,
			"ServiceImage" => $ServiceImagePath,
			'Status' =>1,
			'CUserID' =>$UserData->UserID,
			'CDate' =>$CurrentDateTime
		]);
	    if($Insert){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function add_service(Request $request)   

	public function service($ServiceID) {
		$Service = Service::where('ServiceID','=',$ServiceID)->first();
		// return $Service;
		return view('admin.service',compact('Service'));
	}//END public function service(ServiseID)

	public function update_service(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$ServiceID =  $request->ServiceID;

		$ServiceData = Service::where("ServiceID",'=',$ServiceID)->first();
		// return $CourseData;
		$CheckServiceImagePath = $request['ServiceImage'];
	    if(is_null($CheckServiceImagePath)) {
	        $ServiceImagePath = $ServiceData['ServiceImage'];
	    }//END if(is_null($CheckServiceImagePath))
	    else {
			$FileName =  $this -> saveImage($request->ServiceImage,'public/assets/images/services',1);
			$ServiceImagePath = "public/assets/images/services/".$FileName;
		}//END else
		$Update =  DB::table('services')->where('ServiceID', $ServiceID)->
			update([
			'ServiceDetails' => $request->ServiceDetails,
			'ServiceName' => $request->ServiceName,
			'ServiceType' => $request->ServiceType,
			'ServicePrice' => $request->ServicePrice,
			'ServiceImage' => $ServiceImagePath,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function update_service(Request $request)

	public function delete_service(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$ServiceID =  $request->ServiceID;
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$ServiceID =  $request->ServiceID;
		$ServiceName = $request->ServiceName;
		$Update =  DB::table('services')->where('ServiceID', $ServiceID)->
			update([
			'Status' => -1,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_service(Request $request)

	#############################################################################################
	####################################### COURSES ############################################
	#############################################################################################
	public function courses() {
		$Courses = Course::where('Status','=','1')->get();
		return view('admin.courses',compact('Courses'));
	}//END public function posts()

	public function add_course(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();

		$CheckCourseImagePath = $request['CourseImage'];
	    if(is_null($CheckCourseImagePath)) {
	        $CourseImagePath = "";
	    }//END if(is_null($CheckCourseImagePath))
	    else {
			$FileName =  $this -> saveImage($request->CourseImage,'public/assets/images/courses',1);
			$CourseImagePath = "public/assets/images/courses/".$FileName;
		}//END else

		$CheckCoursePresenterImage = $request['CoursePresenterImage'];
	    if(is_null($CheckCoursePresenterImage)) {
	        $CoursePresenterImagePath = "";
	    }//END if(is_null($CheckCoursePresenterImage))
	    else {
			$FileName = $this -> saveImage($request->CoursePresenterImage,'public/assets/images/courses',2);
			$CoursePresenterImagePath = "public/assets/images/courses/".$FileName;
		}//END else


		$CheckCourseLogo = $request['CourseLogo'];
	    if(is_null($CheckCourseLogo)) {
	        $CourseLogoPath = "";
	    }//END if(is_null($CheckCourseLogo))
	    else {
			$FileName =  $this -> saveImage($request->CourseLogo,'public/assets/images/courses',3);
			$CourseLogoPath = "public/assets/images/courses/".$FileName;
		}//END else

		$Insert = Course::create([
			"CourseName" => $request->CourseName,
			"CoursePresenter" => $request->CoursePresenter,
			"CourseDate" => $request->CourseDate,
			"CourseHours" => $request->CourseHours,
			"CourseType" => $request->CourseType,
			"CourseLink" => $request->CourseLink,
			"CourseImage" => $CourseImagePath,
			"CoursePresenterImage" => $CoursePresenterImagePath,
			"CourseLogo" => $CourseLogoPath,
			'Status' =>1,
			'CUserID' =>$UserData->UserID,
			'CDate' =>$CurrentDateTime
		]);
	    if($Insert){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function add_service(Request $request)   

	public function course($CourseID) {
		$Course = Course::where('CourseID','=',$CourseID)->first();
		// return $Course;
		return view('admin.course',compact('Course'));
	}//END public function course($CourseID)
	public function update_course(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$CourseID =  $request->CourseID;
		$CourseData = Course::where("CourseID",'=',$CourseID)->first();
		// return $CourseData;
		$CheckCourseImagePath = $request['CourseImage'];
	    if(is_null($CheckCourseImagePath)) {
	        $CourseImagePath = $CourseData['CourseImage'];
	    }//END if(is_null($CheckCourseImagePath))
	    else {
			$FileName =  $this -> saveImage($request->CourseImage,'public/assets/images/courses',1);
			$CourseImagePath = "public/assets/images/courses/".$FileName;
		}//END else

		$CheckCoursePresenterImage = $request['CoursePresenterImage'];
	    if(is_null($CheckCoursePresenterImage)) {
	        $CoursePresenterImagePath = $CourseData['CoursePresenterImage'];
	    }//END if(is_null($CheckCoursePresenterImage))
	    else {
			$FileName = $this -> saveImage($request->CoursePresenterImage,'public/assets/images/courses',2);
			$CoursePresenterImagePath = "public/assets/images/courses/".$FileName;
		}//END else
		$CheckCourseLogo = $request['CourseLogo'];
	    if(is_null($CheckCourseLogo)) {
	        $CourseLogoPath = $CourseData['CourseLogo'];
	    }//END if(is_null($CheckCourseLogo))
	    else {
			$FileName =  $this -> saveImage($request->CourseLogo,'public/assets/images/courses',3);
			$CourseLogoPath = "public/assets/images/courses/".$FileName;
		}//END else

		$Update =  DB::table('courses')->where('CourseID', $CourseID)->
			update([
			'CourseName' => $request->CourseName,
			'CoursePresenter' => $request->CoursePresenter,
			'CourseDate' => $request->CourseDate,
			'CourseHours' => $request->CourseHours,
			'CourseType' => $request->CourseType,
			'CourseLink' => $request->CourseLink,
			"CourseImage" => $CourseImagePath,
			"CoursePresenterImage" => $CoursePresenterImagePath,
			"CourseLogo" => $CourseLogoPath,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }

	}//END public function update_course(Request $request)
	public function delete_course(Request $request) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$CourseID =  $request->CourseID;
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$CourseID =  $request->CourseID;
		$Update =  DB::table('courses')->where('CourseID', $CourseID)->
			update([
			'Status' => -1,
			'UUserID' =>$UserData->UserID,
			'UDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_course(Request $request)
	public function search(Request $request) {
		//return $request;
		$SearchText = $request->SearchText;
		$CityID = $request->CityID;
		$LicenseType = $request->LicenseType;
		$Experience	= $request->Experience;
		$FieldID = $request->FieldID;
		$CityCondition = ' and 1 = 1 ';
		$LicenseTypeCondition = ' and 1 = 1 ';
		$ExperienceCondition = ' and 1 = 1 ';
		$SearchTextCondition = ' and 1 = 1 ';
		$FieldCondition = ' and 1 = 1 ';
		if($CityID != -1) {
			$CityCondition = " and lawyers.CityID = ".$CityID;
		}//END if($CityID != -1)
		if($LicenseType != -1) {
			$LicenseTypeCondition = ' and lawyers.LicenseType = '.$LicenseType;
		}//END if($LicenseType != -1)
		if($Experience != -1) {
			$ExperienceCondition = ' and lawyers.Experience >= '.$Experience;
		}//END if($Experience != -1)
		if(!empty($SearchText)) {
			$SearchTextCondition = " and lawyers.FirstName like ".'"%'.$SearchText.'%"'." or lawyers.LastName like ".'"%'.$SearchText.'%"';
		}//END if(!empty($SearchText))
		if($FieldID != -1) {
			$FieldCondition = " and lawyers.FieldID = ".$FieldID;
		}//END if($FieldID != -1)
		// return $CityCondition;
		// $SearchResult = Lawyer::with('qualification')->where([['LawyerID','>','0'],[$CityCondition]])->OrderBy('Experience','Desc')->get();

		  $SearchResult = \DB::select("SELECT lawyers.*,cities.CityID,cities.CityName,
		  							   qualifications.QualificationID,qualifications.QualificationName,
		  							   fields.FieldID,fields.FieldName
		  							   from lawyers 
		  							   INNER JOIN cities ON cities.CityID = lawyers.CityID
		  							   INNER JOIN qualifications ON qualifications.QualificationID = lawyers.QualificationID
		  							   INNER JOIN fields ON fields.FieldID = lawyers.FieldID
		  							   WHERE LawyerID > 0 $CityCondition $LicenseTypeCondition $ExperienceCondition $SearchTextCondition $FieldCondition");

	      // dd($SearchResult);
	      // var_dump($SearchResult);
	      // return $SearchResult;	
	      $CountResult = sizeof($SearchResult);
	      return view('search-result',compact('SearchResult','CountResult'));
	      redirect('search-result',compact('SearchResult','CountResult'));
		/*
		if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 ) {
			$SearchResult = Lawyer::with('qualification')->where([['CityID','=',$CityID],['LicenseType','=',$LicenseType],['Experience','>=',$Experience],['FirstName', 'like', '%' . $SearchText .'%']])->orWhere([['LastName', 'like', '%' . $SearchText .'%']])->OrderBy('Experience','Desc')->get();
		}//END if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 )
		else if(empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 ) {
			$SearchResult = Lawyer::with('qualification')->where([['CityID','=',$CityID],['LicenseType','=',$LicenseType],['Experience','>=',$Experience]])->OrderBy('Experience','Desc')->get();
		}//END else if(empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 )
		else if(!empty($SearchText) and $CityID == -1 and $LicenseType != -1 and $Experience != -1 ) {
			$SearchResult = Lawyer::with('qualification')->where([['LicenseType','=',$LicenseType],['Experience','>=',$Experience],['FirstName', 'like', '%' . $SearchText .'%']])->orWhere([['LastName', 'like', '%' . $SearchText .'%']])->OrderBy('Experience','Desc')->get();
		}//END else if(!empty($SearchText) and $CityID == -1 and $LicenseType != -1 and $Experience != -1 )
		else if(!empty($SearchText) and $CityID != -1 and $LicenseType == -1 and $Experience != -1 ) {
			$SearchResult = Lawyer::with('qualification')->where([['CityID','=',$CityID],['Experience','>=',$Experience],['FirstName', 'like', '%' . $SearchText .'%']])->orWhere([['LastName', 'like', '%' . $SearchText .'%']])->OrderBy('Experience','Desc')->get();
		}//END else if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 )
		else if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience == -1 ) {
			$SearchResult = Lawyer::with('qualification')->where([['CityID','=',$CityID],['LicenseType','=',$LicenseType],['FirstName', 'like', '%' . $SearchText .'%']])->orWhere([['LastName', 'like', '%' . $SearchText .'%']])->OrderBy('Experience','Desc')->get();
		}//END else if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience == -1 )
		else if(empty($SearchText) and $CityID == -1 and $LicenseType == -1 and $Experience == -1 ) {
			$SearchResult = Lawyer::with('qualification')->OrderBy('Experience','Desc')->get();
		}//END if(!empty($SearchText) and $CityID != -1 and $LicenseType != -1 and $Experience != -1 )
		*/
		return $SearchResult;
	}//END public function search(Request $request)

	public function lawyers() {
		$Lawyers = Lawyer::with('qualification','fields','city')->where([['status','=','1']])->get();
		return view('layout.admin.lawyers',compact('Lawyers'));
	}//END public function lawyers()
	public function show_lawyer($LawyerID) {
		$Lawyer = Lawyer::with('qualification','fields','city')->where([['status','=','1'],['LawyerID','=',$LawyerID]])->first();
		return view('layout.admin.lawyer',compact('Lawyer'));
	}//END public function show_lawyer($LawyerID)
	public function delete_lawyer($LawyerID) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$Lawyer = Lawyer::where([['status','=','1'],['LawyerID','=',$LawyerID]])->first();
		$NewEmail = $Lawyer->Email."_".$LawyerID;
		$NewPhoneNumber = $Lawyer->PhoneNumber."_".$LawyerID;
		$Update =  DB::table('lawyers')->where('LawyerID', $LawyerID)->
			update([
			'Email' => $NewEmail,
			'PhoneNumber' => $NewPhoneNumber,
			'Status' => '-1',
			'DUserID' =>$UserData->UserID,
			'DDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_lawyer($LawyerID)


	public function providers() {
		$Providers = Provider::with('city')->where([['status','=','1']])->get();
		return view('layout.admin.providers',compact('Providers'));
	}//END public function providers()

	public function show_provider($ProviderID) {
		$Provider = Provider::with('city')->where([['status','=','1'],['ProviderID','=',$ProviderID]])->first();
		return view('layout.admin.provider',compact('Provider'));
	}//END public function show_provider($ProviderID)
	public function delete_provider($ProviderID) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$Provider = Provider::where([['status','=','1'],['ProviderID','=',$ProviderID]])->first();
		$NewEmail = $Provider->Email."_".$ProviderID;
		$NewPhoneNumber = $Provider->PhoneNumber."_".$ProviderID;
		$Update =  DB::table('providers')->where('ProviderID', $ProviderID)->
			update([
			'Email' => $NewEmail,
			'PhoneNumber' => $NewPhoneNumber,
			'Status' => '-1',
			'DUserID' =>$UserData->UserID,
			'DDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_provider($ProviderID)

	public function customers() {
		$Customers = Customer::with('city')->where([['status','=','1']])->get();
		return view('layout.admin.customers',compact('Customers'));
	}//END public function customers()
	public function show_customer($CustomerID) {
		$Customer = Customer::with('city')->where([['status','=','1'],['CustomerID','=',$CustomerID]])->first();
		return view('layout.admin.customer',compact('Customer'));
	}//END public function show_customer($CustomerID)
	public function delete_customer($CustomerID) {
		$CurrentDateTime = date('Y-m-d h:i:s', Time());
		$UserData =  $this ->user_data();
		$Customer = Customer::where([['status','=','1'],['CustomerID','=',$CustomerID]])->first();
		$NewEmail = $Customer->Email."_".$CustomerID;
		$NewPhoneNumber = $Customer->PhoneNumber."_".$CustomerID;
		$Update =  DB::table('customers')->where('CustomerID', $CustomerID)->
			update([
			'Email' => $NewEmail,
			'PhoneNumber' => $NewPhoneNumber,
			'Status' => '-1',
			'DUserID' =>$UserData->UserID,
			'DDate' => $CurrentDateTime
		]);
		if($Update){
	    	return response()->json([
                'status' => true,
                'msg'    => 'Success',
            ]);
	    }
	    else {
	    	return response()->json([
                'status' => false,
                'msg'    => 'Faild',
            ]);
	    }
	}//END public function delete_customer($CustomerID)


    protected function saveImage($photo,$folder,$counter){
	    $file_extention = $photo ->getClientOriginalExtension();
	    $file_name = time().$counter.'.'.$file_extention;
	    $path = $folder;
	    $photo->move($path,$file_name);
	    return $file_name;
	}//END protected function saveImage($photo,$folder)
}//END class MainController extends Controller
