@extends('layout.main_master')
@section('content')
	<div class="container-fluid mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
					<div class="container">
						<center><h1>الخدمات المتاحة</h1></center>
					@if($Services->Count() > 0)
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
								@endphp
								<div class="col-md-3 service_card">
									<!-- <div class="container mt-1"> -->
										<div class="card service_card">
								    		<div class="card-header">
								    			<img src="{{asset($Service->ServiceImage)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
								    			<center><h4>{{$Service->ServiceName}}</h4></center>
								    		</div>
										    <div class="card-body">
										  		<table>
			                						<tr>
			                							<td align="right" width="" style="text-align:right; float: right;">
			                								<div class="" style="text-align: ;"> نوع الخدمة     <br> {{$ServiceTypeName}} </div>
			                							</td>
			                							<td width=""></td>
			                							<td align="left" width="" style="text-align:left; float: left;">
			                									<div class="" > السعر  <br> <div class="number" style="margin-right: 120px; text-align: center;"> {{$Service->ServicePrice}} SAR  </div></div>
											    						
			                							</td>
			                						</tr>
			                					</table>
										    </div> 
										    <div class="card-footer">
										    	 <a href="order/{{$Service->ServiceID}}" class="btn btn-primary button" style="width: 100%;" onclick="hide_all()">تفاصيل وطلب   الخدمة</a>

										    	 <!-- <button id="SaveCompany" class="btn btn-primary button" type="submit" onclick="return Service({{$Service->ServiceID}});" style="width: 100%;">تفاصيل  و طلب الخدمة</button> -->
										    </div>
								  		</div>
									<!-- </div> -->
								</div>
							@endforeach
						</div>
					@endif
				</div>
		</div>
	</div>
@endsection