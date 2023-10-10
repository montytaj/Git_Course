@extends('layout.main_master')
@section('content')
	<div class="container-fluid row mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
	 				<div class="container-fluid" style="margin-bottom: 5%; margin-top: 2%;">
						<center><h1>الدورات المتاحة</h1></center>
					@if($Courses->Count() > 0)
						<div class="row g-2">
							@foreach($Courses as $Course)
								@php
									/*
									$ServiceTypeName = "";
									if($Service->ServiceType == 1) {
										$ServiceTypeName = "قانونية";
									}//END if($Service->ServiceType == 1)
									else if($Service->ServiceType == 2) {
										$ServiceTypeName = "أخرى";
									}//END else if($Service->ServiceType == 2)
									*/
								@endphp
								<div class="col-md-4 ">
									<div class="card service_card">
								    		<div class="card-header">
								    			@php
								    				if(empty($Course->CourseImage)) {
								    					$CourseImg = 'assets/img/2.jpg';
								    				}//END if(empty($Course->CourseImage))
								    				else {
								    					$CourseImg = $Course->CourseImage;
								    				}

								    				if(empty($Course->CourseLogo)) {
								    					$CourseLogo = 'assets/img/2.jpg';
								    				}//END if(empty($Course->CourseLogo))
								    				else {
								    					$CourseLogo = $Course->CourseLogo;
								    				}

								    				if(empty($Course->CoursePresenterImage)) {
								    					$CoursePresenterImage = 'assets/img/login.png';
								    				}//END if(empty($Course->CoursePresenterImage))
								    				else {
								    					$CoursePresenterImage = $Course->CoursePresenterImage;
								    				}

								    				if($Course->CourseType == 1) {
								    					$CourseTypeName = "حضوري  ";
								    				}//END if($Course->CourseType == 1)
								    				else if($Course->CourseType == 2) {
								    					$CourseTypeName = "أونلاين";
								    				}//END else if($Course->CourseType == 2)


								    			@endphp
								    			<img src="{{asset($CourseImg)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
								    			<center>{{$Course->CourseName}}</center>
								    		</div>
										    <div class="card-body">
			                        					<div class="row">
			                        						<div class="col align-self-start">
			                        							<div class="" style="text-align:center; ;"> نوع  الدورة    <br> {{$CourseTypeName}} </div>
			                        						</div>

			                        						<div class="col align-self-start"></div>

			                        						<div class="col align-self-start">
			                        							<div class="Icon-inside" style="">
													        			<i class="fa fa-clock-o fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 60px;"></i>
													    				<div class="CourseHours" style=""> عدد الساعات  <br> <div class="number" style=""> {{$Course->CourseHours}} ساعة  </div></div>
													    			</div>
			                        						</div>
			                        					</div>

			                        					<div class="row">
			                        						<div class="col align-self-start">
			                        							<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;margin-right: 10px;" src="{{asset($CoursePresenterImage)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
			                        						</div>

			                        						<div class="col align-self-start"></div>

			                        						<div class="col align-self-start">
			                        							<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;margin-right: 10px;"  src="{{asset($CourseLogo)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
			                        						</div>
			                        					</div>
			                        					<div class="row">
			                        						<div class="col align-self-start">
			                        							<div class="CourseDetails" style="min-width: 100px; width: 200px;"> {{$Course->CoursePresenter}}</div>
			                        						</div>

			                        						<div class="col align-self-center"></div>

			                        						<div class="col align-self-end">
			                        							<div class="CourseDetails" style=""> {{$Course->CourseDate}}</div>
			                        						</div>
			                        					</div>

			                        				
			                        			<div class="row" style="display: none;">
						                            <div class="col-lg-4">
						                        		<img style="border-radius: 50%; border: 0.3rem solid rgba(0, 0, 0, 0.1);width: 5rem;height: 5rem" src="{{asset($CoursePresenterImage)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
						                        		<div class="CourseDetails" style="min-width:300px;max-width: 300px;min-height: 10px;max-height: 10px; "> {{$Course->CoursePresenter}}</div>
						                        	</div>

						                        	<div class="col-lg-4"></div>
						                        	<div class="col-lg-4">
						                        		<img style="border-radius: 50%; border: 0.3rem solid rgba(0, 0, 0, 0.1);width: 5rem;height: 5rem" src="{{asset($CourseLogo)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
						                        		<div class="CourseDetails" style="min-width:300px;max-width: 300px;min-height: 10px;max-height: 10px; "> {{$Course->CourseDate}}</div>
						                        	</div>
						                        </div>
										    </div> 
										    <div class="card-footer">
										    	 <a href="http://www.{{$Course->CourseLink}}" target="_blank" class="btn btn-primary service_btn" style="width: 100%; "><h3> رابط الدورة   </h3> </a>
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