@extends('layout.main_master')

@section('content')
<div class="container row mx-auto align-items-center">
 <div class="header-container container">
  <div class="gradient-bg"></div> 
  <div class="row">
   <div class="col-md-1">  
   </div>
   <div class="col-md-5">
    <h1> منصة  لوائح  للخدمات القانونية  </h1>
    <div class="d-flex header-container_actions">
     <button class="btn button  " type="text" >الآن انضم للمنصة</button>
    <div class="registration"> <button class="show_all_btn" type="text"  style="margin-right: 20px;" > منصة   الإستشارات</button>
    </div>
    </div>
   </div>
   <div class="col-md-5">
    <img class="header-img" src="assets/img/1.jpg" alt="">
   </div>
   <div class="col-md-1">
   </div>
  </div>

  <section class="registration header-container_actions">
	   <div class="container">
	   	<center>
	   	  <div class="row g-0">
		    <div class="col-md-1">
		    </div>
		    <div class="col-md-3">
		      <div class="p-3"><button class="btn button " type="text" id="RegistrationLawer" onclick="Registration(1);"> انضم كمحامي</button></div>
		    </div>
		    <div class="col-md-4">
		      <div class="p-3"><button class="show_all_btn" type="text" id="RegistrationProvider" onclick="Registration(2);"> انضم  كشركة أو مكتب محاماة </button></div>
		    </div>
		    <div class="col-md-3">
		      <div class="p-3"><button class="btn button " type="text" id="RegistrationCustomer" onclick="Registration(3);"> انضم كعميل</button></div>
		    </div>
		    <div class="col-md-1">
		    </div>
		  </div>
		  </center>
		</div>
  </section>

  <section class="registration-section">
        	<br>
	<div class="row" id="AddLawyerSuccessMessage" style="display: none;">
		<div class="form-group col-sm-3">
			<span><!-- SPACE ONLY  --></span>
		</div>

		<div class="form-group col-sm-6">
			<div class="alert alert-success" role="alert">
				<center> تم التسجيل بنجاح  </center>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<span><!-- SPACE ONLY  --></span>
		</div>
	</div>

	<div class="row" id="DangerMessage" style="display: none;">
		<div class="form-group col-sm-3">
			<span><!-- SPACE ONLY  --></span>
		</div>

		<div class="form-group col-sm-6">
			<div class="alert alert-danger" role="alert">
				<center> لم يتم التسجيل   </center>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<span><!-- SPACE ONLY  --></span>
		</div>
	</div>

        <div class="modal MyModal" role="dialog" id="RegistrationLawerModel" style="">
	        <div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <div class="" >
	              	<div class="modal-title" style="text-align: center;"><h3><center> انضم كمحامي  </center></h3></div>
	              </div>
	        	</div>
	            <div class="modal-body">
	            	<center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style=""> </div></center>
	            	 <form method="post" name="LawyerForm" id="LawyerForm" onsubmit="return validation('LawyerForm');" enctype="multipart/form-data">
	            	 	@csrf
						<div class="row">
							<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="text" class="registration-input" name="FirstName" id="FirstName" placeholder="الأسم الأول">
						        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
						  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="text" class="registration-input" name="LastName" id="LastName" placeholder="الأسم الأخير">
						        <i class="fa fa-user-plus fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
						  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <select class="registration-input" name="QualificationID" id="QualificationID" >
						        	<option value="-1">-اختر المؤهل-</option>
						        	@foreach($Qualifications as $Qualification)
					        			<option value="{{$Qualification->QualificationID}}">{{$Qualification->QualificationName}}</option>
					        		@endforeach
						        </select>
						        <i class="fa fa-car-noneed fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  </div>
						</div>
					  <div class="row">
						<div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="text" class="registration-input" name="Specialism" id="Specialism" placeholder="التخصص">
					        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					  <div class="col-md-4">
					      <div class="Icon-inside">
					        <select class="registration-input" name="LicenseType" id="LicenseType" >
					        	<option value="-1">-- اختر نوع الرخصة --</option>
					        	<option value="1">مرخص   </option>
					        	<option value="2"> متدرب </option>
					        </select>
					        <i class="fa fa-user-noneed fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					  <div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="file" class="registration-input" name="LicensePath" id="LicensePath" placeholder="ارفق الرخصة">
					        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					</div>
					<div class="row">
						<div class="col-md-4">
					      <div class="Icon-inside">
					        <select class="registration-input" name="Experience" id="Experience" >
					        	<option value="-1">الخبرة</option>
					        	<?php
					        	for($i=1;$i<=50;$i++) {
					        		echo "<option value=".$i.">".$i."</option>";
					        	}//END for($i=1;$i<=50;$i++)
					        	?>
					        </select>
					        <i class="fa fa-level-up-noneed fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
						</div>
						<div class="col-md-4">				      
					      <div class="Icon-inside">
					        <select class="registration-input" name="CityID" id="CityID" >
					        	<option value="-1">اختر المدينة</option>
					        	@foreach($Cities as $City)
					        		<option value="{{$City->CityID}}">{{$City->CityName}}</option>
					        	@endforeach
					        </select>
					        <i class="fa fa-user-nodeed fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					  <div class="col-md-4">
					      <div class="Icon-inside">
					        <select class="registration-input" name="FieldID" id="FieldID" >
					        	<option value="-1">اختر المجال </option>@foreach($Fields as $Field)
					        		<option value="{{$Field->FieldID}}">{{$Field->FieldName}}</option>
					        	@endforeach
					        </select>
					        <i class="fa fa-user-noneed fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				  </div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="Icon-inside">
							<input type="email"  class="registration-input" name="Email" id="Email" placeholder="البريد">
							<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
						</div>
				  	</div>
				  	<div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="tel"  class="registration-input" name="PhoneNumber" id="PhoneNumber" placeholder="الجوال">
					        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					<div class="col-md-4">
				      <div class="Icon-inside">
				        <input type="password"  class="registration-input" name="Password" id="Password" placeholder="كلمة المرور">
				        <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				  	</div>
				  </div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button id="SaveLawyer" class="btn btn-primary button" type="submit" onclick="return validation('LawyerForm');">تسجيل</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button type="button" class="btn btn-danger button colse text-center" data-dismiss="modal" onclick="Close(1);">إغلاق &times;</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
				</form>
				    
				    <form style="display: none;">
					    <h2>Icon appears to be outside of the input text</h2>
				      <div class="Icon-outside">
				        <input type="text" placeholder="Enter Name">
				        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				      <div class="Icon-outside">
				        <input type="email" placeholder="Email">
				        <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				      <div class="Icon-outside">
				        <input type="tel" placeholder="Enter Number">
				        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				    </form>
	            </div>
               </div>
              </div>
             </div>

           <div class="modal MyModal" role="dialog" id="RegistrationCompanyModel" style="">
	       		<div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <div class="" >
	              	<div class="modal-title" style="text-align: center;"><h3><center> انضم كشركة أو مكتب محاماة  </center></h3></div>
	              </div>
	        	</div>
	            <div class="modal-body">
	            	<center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="ProviderErrorLabel" style=""> </div></center>
	            	 <form method="post" name="CompanyForm" id="CompanyForm" onsubmit="return validation('CompanyForm');" enctype="multipart/form-data">
	            	 	@csrf
						<div class="row">
							<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="text" class="registration-input" name="ProviderName" id="ProviderName" placeholder="الإسم">
						        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
						  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <select class="registration-input" name="ProviderType" id="ProviderType" >
						        	<option value="-1">-- اختر النوع --</option>
						        	<option value="1"> شركة   </option>
						        	<option value="2"> مكتب  </option>
						        </select>
						        <i class="fa fa-car-noneed fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  </div>
						  <div class="col-md-4">				      
						      <div class="Icon-inside">
						        <select class="registration-input" name="CityID" id="CityID" >
						        	<option value="-1">اختر المدينة</option>
						        	@foreach($Cities as $City)
						        		<option value="{{$City->CityID}}">{{$City->CityName}}</option>
						        	@endforeach
						        </select>
						        <i class="fa fa-user-nodeed fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
					 	 </div>
						</div>
					  <div class="row">
						<div class="col-md-8">
					      <div class="Icon-inside">
					         <textarea name="Address" class="registration-input" id="Address" placeholder="العنوان"></textarea>
					        <i class="fa fa-user-noneed fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					  <div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="file" class="registration-input" name="LicensePath" id="LicensePath" placeholder="ارفق الترخيص">
					        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  </div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="Icon-inside">
								<input type="email"  class="registration-input" name="Email" id="Email" placeholder="البريد">
								<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
							</div>
					  	</div>
					  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="tel"  class="registration-input" name="PhoneNumber" id="PhoneNumber" placeholder="الجوال">
						        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  </div>
						<div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="password"  class="registration-input" name="Password" id="Password" placeholder="كلمة المرور">
					        <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  	</div>
				  </div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button id="SaveCompany" class="btn btn-primary button" type="submit" onclick="return validation('CompanyForm');">تسجيل</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button type="button" class="btn btn-danger button colse text-center" data-dismiss="modal" onclick="Close(2);">إغلاق &times;</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
				</form>
	            </div>
               </div>
              </div>
           </div>

            <div class="modal MyModal" role="dialog" id="RegistrationCustomerModel" style="">
	       		<div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <div class="" >
	              	<div class="modal-title" style="text-align: center;"><h3><center> انضم كعميل   </center></h3></div>
	              </div>
	        	</div>
	            <div class="modal-body">
	            	<center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="CustomerErrorLabel" style=""> </div></center>
	            	 <form method="post" name="CustomerForm" id="CustomerForm" onsubmit="return validation('CustomerForm');" enctype="multipart/form-data">
	            	 	@csrf
						<div class="row">
							<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="text" class="registration-input" name="FirstName" id="FirstName" placeholder="الإسم">
						        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
						  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="text" class="registration-input" name="LastName" id="LastName" placeholder="الإسم">
						        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
						  <div class="col-md-4">				      
						      <div class="Icon-inside">
						        <select class="registration-input" name="CityID" id="CityID" >
						        	<option value="-1">اختر المدينة</option>
						        	@foreach($Cities as $City)
						        		<option value="{{$City->CityID}}">{{$City->CityName}}</option>
						        	@endforeach
						        </select>
						        <i class="fa fa-user-nodeed fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
					 	 </div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="Icon-inside">
									<input type="email"  class="registration-input" name="Email" id="Email" placeholder="البريد">
									<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
								</div>
						  	</div>
						  	<div class="col-md-4">
							      <div class="Icon-inside">
							        <input type="tel"  class="registration-input" name="PhoneNumber" id="PhoneNumber" placeholder="الجوال">
							        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
							      </div>
							  </div>
							<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="password"  class="registration-input" name="Password" id="Password" placeholder="كلمة المرور">
						        <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						  	</div>
					  </div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button id="SaveCustomer" class="btn btn-primary button" type="submit" onclick="return validation('CustomerForm');">تسجيل</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<center><button type="button" class="btn btn-danger button colse text-center" data-dismiss="modal" onclick="Close(3);">إغلاق &times;</button></center>
						</div>
						<div class="col-md-4"></div>
					</div>
				</form>
	            </div>
               </div>
              </div>
           </div>
  </section>

	<section class="services-section" id="services-section" style="margin-bottom: 150px;">
		<div class="container-fluid">
		@if($Services->Count() > 0)
			<center><h1> الخدمات المتاحة </h1></center>	
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
					<div class="col-md-3 ">
						<div class="card service_card">
						    <div class="card-header">
						    	<img src="{{asset($Service->ServiceImage)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
						    	<center>{{$Service->ServiceName}}</center>
						    </div>
							<div class="card-body">
								<div class="row">
				                	<div class="col align-self-start">
				                		<div class="" style="text-align: ;"> نوع الخدمة     <br> {{$ServiceTypeName}} </div>
				                	</div>
				                	<div class="col align-self-center">

				                	</div>
				                	<div class="col align-self-end">
				                		<div class="Icon-inside" style="margin-left: 15px; text-align: left;">
									        <div class="product_price" style="text-align:;"> السعر  <br> <div class="number" style="margin: 0 auto; text-align: center;"> {{$Service->ServicePrice}} SR  </div></div>
									    </div>	
				                	</div>
								</div>
							</div> 
							<div class="card-footer">
								 <a href="order/{{$Service->ServiceID}}" class="btn btn-primary service_btn" style="width: 100%;" ><h3>طلب   الخدمة  </h3> </a>
						    </div>
						</div>
					</div>
			@endforeach
		</div>
		<br>
	<center>
		<a href="services" class="show_all " target="_blank" style="">كل الخدمات</a>
	</center>
	@endif		
</div>
</section>

<section class="courses-section" id="courses-section" style="margin-bottom: 150px;">
	<div class="container-fluid">
		@if($Courses->Count() > 0)
			<center><h1> الدورات المتاحة  </h1></center>
			<div class="row g-4">
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
			                        <div class="col align-self-center"></div>
			                        <div class="col align-self-end">
			                        	<div class="Icon-inside" style="">
											<i class="fa fa-clock-o fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 60px;"></i>
											<div class="CourseHours" style=""> عدد الساعات  <br> 
												<div class="number" style=""> {{$Course->CourseHours}} ساعة  
											   </div>
											</div>
										</div>
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col align-self-start">
			                        	<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;margin-right: 10px;" src="{{asset($CoursePresenterImage)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
			                        </div>
			                        <div class="col align-self-start"></div>
			                        <div class="col align-self-center">
			                        	<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;margin-right: 10px;"  src="{{asset($CourseLogo)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
			                        </div>
			                    </div>
			                    <div class="row">
			                    	<div class="col align-self-start">
			                        	<div class="CourseDetails" style="min-width: 100px;"> {{$Course->CoursePresenter}}</div>
			                        </div>
			                        <div class="col align-self-center"></div>
			                        <div class="col align-self-end">
			                        	<div class="CourseDetails" style=""> {{$Course->CourseDate}}</div>
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
			<br>
			<center>
				<a href="courses" class="show_all" target="_blank" style="">كل  الدورات</a>
			</center>
		@endif	
	</div>
</section>

<section class="library-section" id="library-section" style="margin-bottom: 150px;">
				<div class="container-fluid">
				@if($Libraries->Count() > 0)
					<center><h1> المكتبة القانونية </h1></center>
					<div class="row g-4">
						@php
							$Counter = 1;
						@endphp
						@foreach($Libraries as $Library)
							@php
								
								$SubjectTypeName = "";
								if($Library->SubjectType == 1) {
									$SubjectTypeName = "مقال";
								}//END if($Library->SubjectType == 1)
								else if($Library->SubjectType == 2) {
									$SubjectTypeName = "تشريع";
								}//END else if($Library->SubjectType == 2)
								if($Counter ==1) {
									$StaticImages = 'assets/img/2.jpg';
									$Counter = $Counter + 1;
								}//END if($Counter ==1)
								else if($Counter ==2) {
									$StaticImages = 'assets/img/3.jpg';
								}//END else if($Counter ==2)
							@endphp
							<div class="col-md-6 ">
								<div class="card service_card">
					    		<div class="card-header">
					    			<img src="{{asset($StaticImages)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
					    			<center>{{$Library->Title}}</center>
					    		</div>
							    <div class="card-body">
                        			<div class="row">
                						<div class="col align-self-start">
                							<div class="" style="text-align: left;"> النوع  <br> {{$SubjectTypeName}} </div>	
                						</div>
                						<div class="col align-self-center"></div>
                						<div class="col align-self-end" style="">
                							<div class="Icon-inside" style="margin-left: 15px; text-align: right;">
								        			<div class="product_price" style="text-align:;"> المجال  <br> <div class="number" style="margin: 0 auto; text-align: right;"> {{$Library->fields->FieldName}}  </div></div>
								    			</div>
                						</div>
                					</div>
                					<hr style="height: 5px;width: 100%;" >
                					 <div class="row">
                						<div class="col align-self-start">
                							<div class="" style=""> الكاتب  <br> {{$Library->Author}} </div>	
                						</div>
                						<div class="col align-self-center"></div>
                						<div class="col align-self-end" style="text-align: left;">
                							<div class="" style=""> تاريخ النشر  <br> {{$Library->FromDate}} </div>	

                						</div>
                					</div>
							    </div> 
							    <div class="card-footer" style="display: none;">
							    	 <a href="order/{{$Service->ServiceID}}" class="btn btn-primary service_btn" style="width: 100%;" ><h3> فتح المقال  </h3> </a>

							    </div>
					  		</div>
							</div>
						@endforeach
					</div>
					<br>
					<center>
						<a href="libraries" class="show_all" target="_blank" style="">كل   المقالات</a>
					</center>
						@endif
					</div>
</section>



<section class="search-section">
	<div class="container">
		<center><h1>
		 البحث عن محامي  
		 </h1></center>
		<br>
		<div class="card searchcard">
			<div class="search-aria">
			     <form action="" method="post" class=" form-inline" id="SearchForm" name="SearchForm">
					@csrf
					<div class="row">
						<div class="col-md-12">
					      <div class="Icon-inside">
					        <input type="text" class="registration-input" name="SearchText" id="SearchText" placeholder=" بحث ">
					        <i class="fa fa-search fa-lg fa-fw" name="Search" id="Search" style="color: #1198B6;align-items: center;top: 6px; " aria-hidden="true"></i>
					      </div>
						</div>
					</div>

					<div class="row advanced-search">
						<div class="col-md-3">
							<div class="Icon-inside">
						        <select class="registration-input" name="CityID" id="CityID" >
						        		<option value="-1">اختر المدينة</option>
						        	@foreach($Cities as $City)
						        		<option value="{{$City->CityID}}">{{$City->CityName}}</option>
						        	@endforeach
						        </select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="Icon-inside">
						        <select class="registration-input" name="FieldID" id="FieldID" >
					        		<option value="-1">اختر المجال </option>
					        		@foreach($Fields as $Field)
					        			<option value="{{$Field->FieldID}}">{{$Field->FieldName}}</option>
					        		@endforeach
					        </select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="Icon-inside">
						    	<select class="registration-input" name="LicenseType" id="LicenseType" >
						        	<option value="-1"> اختر نوع الرخصة  </option>
						        	<option value="1">مرخص   </option>
						        	<option value="2"> متدرب </option>
					        	</select>
							</div>
						</div>

						<div class="col-md-3">
							<div class="Icon-inside">
						   		<select class="registration-input" name="Experience" id="Experience" >
						        	<option value="-1">الخبرة</option>
						        	<?php
						        	for($i=1;$i<=50;$i++) {
						        		echo "<option value=".$i.">".$i."</option>";
						        	}//END for($i=1;$i<=50;$i++)
						        	?>
					        	</select>
							</div>
						</div>
					</div>          
			    </form>
			</div>
</div>
</div>

   <br><br><br>





</section>


@endsection
<script>
 function Registration(RegistrationType)
      {
       //alert("Montasir");
       //alert(RegistrationType);
        if(RegistrationType == 1)
          {
           //alert("Montasir IN");
           $("#RegistrationLawerModel").css("display","block");
             /*$(".modal-dialog").css("display","block");
             $(".modal-content").css("display","block");
             $(".modal-body").css("display","block"); */
           }//END  if(RegistrationType == 1)
        else if(RegistrationType == 2)
          {
           $("#RegistrationCompanyModel").css("display","block");
             /*$(".modal-dialog").css("display","block");
             $(".modal-content").css("display","block");
             $(".modal-body").css("display","block");*/
           }//END  if(RegistrationType == 2)
         else if(RegistrationType == 3)
          {
           $("#RegistrationCustomerModel").css("display","block");
             /*$(".modal-dialog").css("display","block");
             $(".modal-content").css("display","block");
             $(".modal-body").css("display","block");*/
           }//END  if(RegistrationType == 3)
           
      }//END function CheckLogin()

 function Close(RegistrationType)
   {
     // alert(RegistrationType);
     if(RegistrationType == 1)
          {
          	$("#RegistrationLawerModel").css("display","none");
          }//END  if(RegistrationType == 1)
        else if(RegistrationType == 2)
          {
          	$("#RegistrationCompanyModel").css("display","none");
          }//END  if(RegistrationType == 2)
         else if(RegistrationType == 3)
          {
           $("#RegistrationCustomerModel").css("display","none");
          }//END  if(RegistrationType == 3)
          else if(RegistrationType == 4)
          {
           $("#ServiceModel").css("display","none");
          }//END  if(RegistrationType == 4)
     
   }//END function Close()
</script>


<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>


<script>
	function validation(FormName) {	
		// alert("Montassssssssssssssir");
		if(FormName == "LawyerForm") {
			if(document.forms["LawyerForm"].elements["FirstName"].value=='') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';	
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["FirstName"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["LastName"].value=='') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry2"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["LastName"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["QualificationID"].value== -1) {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry3"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["QualificationID"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["Specialism"].value== '') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry4"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["Specialism"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["LicenseType"].value== -1) {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry5"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["LicenseType"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["Experience"].value== -1) {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry6"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["Experience"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["CityID"].value== -1) {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry7"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["CityID"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["FieldID"].value== -1) {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry8"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["FieldID"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["Email"].value== '') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry9"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["Email"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["PhoneNumber"].value== '') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry10"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["PhoneNumber"].focus();
				return false;
			}
			if(document.forms["LawyerForm"].elements["Password"].value== '') {
				document.getElementById('errorLabel').innerHTML="<?php echo "Sorrry11"; ?>";
				document.getElementById('errorLabel').style.visibility = 'visible';
				document.getElementById('errorLabel').style.display = 'block';	
				document.forms["LawyerForm"].elements["Password"].focus();
				return false;
			}
			else {
				document.getElementById('errorLabel').style.visibility = 'collapse';	
			}
		}//END if(FormName == "LawyerForm")
		else if(FormName == "CompanyForm") {
			// alert("CompanyForm");
			if(document.forms["CompanyForm"].elements["ProviderName"].value=='') {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "ProviderName is Required"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';	
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["ProviderName"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["ProviderType"].value== -1) {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry ProviderType"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["ProviderType"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["CityID"].value== -1) {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry7"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["CityID"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["Address"].value=='') {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry2"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["Address"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["LicensePath"].value== '') {
				// alert("Montassssssssssssssir");
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry4"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["LicensePath"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["Email"].value== '') {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry9"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["Email"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["PhoneNumber"].value== '') {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry10"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["PhoneNumber"].focus();
				return false;
			}
			if(document.forms["CompanyForm"].elements["Password"].value== '') {
				document.getElementById('ProviderErrorLabel').innerHTML="<?php echo "Sorrry11"; ?>";
				document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
				document.getElementById('ProviderErrorLabel').style.display = 'block';	
				document.forms["CompanyForm"].elements["Password"].focus();
				return false;
			}
			else {
				document.getElementById('ProviderErrorLabel').style.visibility = 'collapse';	
			}
		}//END if(FormName == "CompanyForm")

		else if(FormName == "CustomerForm") {
			// alert("CompanyForm");
			if(document.forms["CustomerForm"].elements["FirstName"].value=='') {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "FirstName is Required"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';	
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["FirstName"].focus();
				return false;
			}
			if(document.forms["CustomerForm"].elements["LastName"].value== '') {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "Sorrry LastName"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["LastName"].focus();
				return false;
			}
			if(document.forms["CustomerForm"].elements["CityID"].value== -1) {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "Sorrry7"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["CityID"].focus();
				return false;
			}
			if(document.forms["CustomerForm"].elements["Email"].value== '') {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "Sorrry9"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["Email"].focus();
				return false;
			}
			if(document.forms["CustomerForm"].elements["PhoneNumber"].value== '') {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "Sorrry10"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["PhoneNumber"].focus();
				return false;
			}
			if(document.forms["CustomerForm"].elements["Password"].value== '') {
				document.getElementById('CustomerErrorLabel').innerHTML="<?php echo "Sorrry11"; ?>";
				document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
				document.getElementById('CustomerErrorLabel').style.display = 'block';	
				document.forms["CustomerForm"].elements["Password"].focus();
				return false;
			}
			else {
				document.getElementById('CustomerErrorLabel').style.visibility = 'collapse';	
			}
		}//END if(FormName == "CompanyForm")
	}//END function validation()

    $(document).on('click', '#SaveLawyer', function(e) {
        e.preventDefault();

        var form_data = new FormData($('#LawyerForm')[0]);


        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('add_lawyer')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    $("#AddLawyerSuccessMessage").show();
                    $("#RegistrationLawerModel").hide();
                    document.getElementById("LawyerForm").reset();
                    setTimeout(function() {
                        $("#AddLawyerSuccessMessage").hide();
                    }, 5000);
                }

            },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });

    ////////////////////// Registration Company Or Office ////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $(document).on('click', '#SaveCompany', function(e) {
        e.preventDefault();
        var form_data = new FormData($('#CompanyForm')[0]);

        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('add_provider')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    $("#AddLawyerSuccessMessage").show();
                    $("#RegistrationCompanyModel").hide();
                    document.getElementById("CompanyForm").reset();
                    setTimeout(function() {
                        $("#AddLawyerSuccessMessage").hide();
                    }, 5000);
                }

            },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });

    //////////////////////////////////////////////////////// Search /////////////////////////////////////////////////

    $(document).on('click', '#Search', function(e) {
        e.preventDefault();
        var form_data = new FormData($('#SearchForm')[0]);
        // alert("Montassssssssssssssir");
        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('search')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    // $("#AddLawyerSuccessMessage").show();
                    // $("#RegistrationCompanyModel").hide();
                    // document.getElementById("ServiceForm").reset();
                    // setTimeout(function() {
                    //     $("#AddLawyerSuccessMessage").hide();
                    // }, 5000);
                }

            },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });

    ////////////////////////////////////////////////////////// END Search ////////////////////////////////////////////

    ////////////////////// Registration Company Or Office ////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $(document).on('click', '#SaveCustomer', function(e) {
        e.preventDefault();
        var form_data = new FormData($('#CustomerForm')[0]);

        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('add_customer')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    $("#AddLawyerSuccessMessage").show();
                    $("#RegistrationCustomerModel").hide();
                    document.getElementById("CustomerForm").reset();
                    setTimeout(function() {
                        $("#AddLawyerSuccessMessage").hide();
                    }, 5000);
                }//END if (data.status == true)
                else {
                	$("#DangerMessage").show();
                    setTimeout(function() {
                        $("#DangerMessage").hide();
                    }, 5000);

                }//END else

            },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });

	////////////////////// Registration Company Or Office ////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $(document).on('click', '#BuyService', function(e) {
        e.preventDefault();
        var form_data = new FormData($('#ServiceForm')[0]);

        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('buyservice')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    $("#AddLawyerSuccessMessage").show();
                    $("#ServiceModel").hide();
                    document.getElementById("ServiceForm").reset();
                    setTimeout(function() {
                        $("#AddLawyerSuccessMessage").hide();
                    }, 5000);
                }//END if (data.status == true)
                else {
                	$("#DangerMessage").show();
                    setTimeout(function() {
                        $("#DangerMessage").hide();
                    }, 5000);

                }//END else

            },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });

    function ServiceValidation() {

    }//END function ServiceValidation()

    function Service(ServiceID) {
    	// alert(ServiceID);
    	$("#ServiceModel").css("display","block");
    }//END function Service(ServiceID)
    
</script>

