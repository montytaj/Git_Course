@extends('layout.main_master')
@section('content')
	<div class="container-fluid mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
					<div class="container">

						@if($CountResult > 0)
							<div class="row g-4">
								@foreach($SearchResult as $Result)
								@php
									$FirstName = $Result->FirstName;
									$LastName = $Result->LastName;
									$LawyerID = $Result->LawyerID;
									$Specialism = $Result->Specialism;
									$LicenseType = $Result->LicenseType;
									$LicensePath = $Result->LicensePath;
									$Experience = $Result->Experience;
									$CityID = $Result->CityID;
									$PhoneNumber = $Result->PhoneNumber;
									$Email = $Result->Email;
									$FieldID = $Result->FieldID;
									$Status = $Result->Status;
									$CDate = $Result->CDate;
									$CityName = $Result->CityName;
									$QualificationName = $Result->QualificationName;
									$FieldName = $Result->FieldName;
									$FullName = $FirstName."  ".$LastName;
								@endphp
									 
								<div class="col-md-12 service_card">
									<!-- <div class="container mt-1"> -->
										<div class="card service_card">
								    		<div class="card-header">
								    			<center><h4>{{$FullName}}</h4></center>
								    		</div>
										    <div class="card-body">
										  		
			                					<div class="row">
			                						<div class="col align-self-start">
														<div class="" style="text-align: left;"> المجال <br> {{$FieldName}} </div>
													</div>
													<div class="col align-self-center"></div>
			                						<div class="col align-self-end" style="">
			                							<div class="" > الخبرة  <br> <div class="number" style=""> {{$Experience}} سنة  </div></div>
			                						</div>
			                					</div>
										    </div> 
										    <div class="card-footer">
										    	 <a href="#/{{$LawyerID}}" class="btn btn-primary button" style="width: 100%;" onclick="hide_all()">تفاصيل  طلب   المحامي</a>
										    </div>
								  		</div>
									<!-- </div> -->
								</div>
								@endforeach
							</div>
						@else
							<br><br><br><br>
							<center>
								<div class="alert alert-danger" style="" id="errorLabel" style=""> <h3>عفوا لا توجد نتائج  </h3> </div>
							</center>
							<br><br><br><br>
						@endif


					</div>
				</div>
			</div>
@endsection