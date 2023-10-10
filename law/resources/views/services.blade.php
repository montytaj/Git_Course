@extends('layout.main_master')
@section('content')
	<div class="container-fluid mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
					<div class="container">
						<center><h1>الخدمات المتاحة</h1></center>
					@if($Services->Count() > 0)
						@php
					  $CustomerID = 0;

					  $CustomerData = session()->get('CustomerData');
					  if(!empty($CustomerData)) {
					  	$CustomerID = $CustomerData->CustomerID;
						//var_dump($CustomerData);
					  }//END if(!empty($CustomerData))
					@endphp
						<div class="row g-4">
							@foreach($Services as $Service)
						@php
							$ServiceTypeName = "";
							if($Service->ServiceType == 1) {
							$ServiceTypeName = "قانونية";
							}//END if($Service->ServiceType == 1)
							else if($Service->ServiceType == 2) {
							$ServiceTypeName = "أخرى";
							}//END else if($Service->ServiceType == 2)
							$ServiceDetails = $Service->ServiceDetails;
							//if($Service->ServiceID == 9) { echo substr($ServiceDetails,0,200);  }
							//$ShowServiceDetails = $ServiceDetails;
							//$ShowServiceDetails = substr($ServiceDetails,0,200);
						@endphp
						<div class="col-md-3 ">
						<div class="card service_card"> 
							<div class="card-header">
								<center>
									<img src="{{asset($Service->ServiceImage)}}" width="100%" height="180px" class="card-img-top img-circle" alt="...">
									<button id="Update" class="btn btn-secondary button" style="width:70%; margin:0 auto;margin-top: -170px; border-radius: 12px; background-color: /*transparent;*/white; opacity: 0.70;max-height: ; border-color:#06BBCC; border-width: 2px;  color: gray;"> {{$Service->ServiceName}}  </button>
								</center>
							</div>
							<div class="card-body" style="padding: 1rem 0rem;">
								
								<center>
									<button id="Update" class="btn btn-secondary button" style="width:60%; margin:0 auto;margin-top: -40px; border-radius: 25px; background-color: gray;max-height: ; border-width: 2px;  color: white"> وصف الخدمة   </button>
								</center>
								<center><div style="max-height: 160;min-height: 160; padding: 10px 20px 10px 20px;text-align: justify; ">{{$ServiceDetails}} </div></center>
							</div>
							<form id="OrderForm" name="OrderForm">
								@csrf
								<input type="hidden" name="CustomerID" id="CustomerID" value="{{$CustomerID}}">
							</form>
							<div class="card-footer" style="border-top: 0px;">
								<center>
									<a href="customers/custome_order/{{$Service->ServiceID}}" class="btn btn-primary " style="width:60%; margin:0 auto;margin-top: -17px; border-radius: 25px; background-color: #06BBCC;max-height: ; border-width: 2px;  color: white" onclick="return chek_session({{$Service->ServiceID}});">
									طلب الخدمة 
									</a>
								</center>
							</div>
						</div>
					</div>
					@endforeach
						</div>
					@endif
				</div>
		</div>
	</div>
@endsection


	<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>

	<script>
		function chek_session(ServiceID) {
			CustomerID = document.getElementById("CustomerID").value;
			// alert(CustomerID);
			// alert(ServiceID);
			if(CustomerID == 0) {
				window.reload("law/lawyer_login_form");
				return false;
			}//END if(CustomerID == 0)
			else if(CustomerID > 0) {
				window.reload("customers/order/ServiceID");
			}//END else if(CustomerID > 0)
		}//END function chek_session()
	</script>
