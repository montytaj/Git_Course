@extends('layout.main_master')

@section('content')

@php
  $CustomerID = 0;

  $CustomerData = session()->get('CustomerData');
  if(!empty($CustomerData)) {
  	$CustomerID = $CustomerData->CustomerID;
	//var_dump($CustomerData);
  }//END if(!empty($CustomerData))
@endphp

<div class="container row mx-auto align-items-center">
	<div class="header-container container">
		<div class="gradient-bg"></div>
		<section id="FirstSection">
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-5">
					<h1> منصة لوائح للخدمات القانونية </h1>

					<p>إنجاز الخدمات القانونية في أقل من ٢٤ ساعة </p>
				</div>
				<div class="col-md-5">
					<img class="header-img" src="public/assets/img/2.png" alt="" style="margin-top: -90px;">
				</div>
				<div class="col-md-1">
				</div>
			</div>
		</section>
		<section class="registration header-container_actions" style="margin-top: -60px;">
			<div class="container">
			    <center>
				<div class="row g-0">
					<div class="col-md-0">
					</div>
					<div class="col-md-2"> </div>
					<div class="col-md-4">
						<div class="p-4">
							<button class="btn button " type="text" id="RegistrationLawer" onclick="Registration(1);"> انضم كمحامي  </button> 
						</div>
					</div>
					<div class="col-md-4" style="display: none;">
						<div class="p-4"><button class="show_all_btn" type="text" id="RegistrationProvider" onclick="Registration(2);"> انضم كمكتب  </button></div>
					</div>
					<div class="col-md-4">
						<div class="p-4"><button class="show_all_btn " type="text" id="RegistrationCustomer" onclick="Registration(3);"> انضم كعميل</button></div>
					</div>
					<div class="col-md-2"> </div>
				</div>
				</center>
			</div>
		</section>

		<section class="registration-section">
			<br>
			<div class="row" id="AddLawyerSuccessMessage" style="display: none;">
				<div class="form-group col-sm-3">
					<span>
						<!-- SPACE ONLY  -->
					</span>
				</div>

				<div class="form-group col-sm-6">
					<div class="alert alert-success" role="alert" style="border-radius: 10px;">
						<center> تم التسجيل بنجاح </center>
					</div>
				</div>

				<div class="form-group col-sm-3">
					<span>
						<!-- SPACE ONLY  -->
					</span>
				</div>
			</div>

			<div class="row" id="DangerMessage" style="display: none;">
				<div class="form-group col-sm-3">
					<span>
						<!-- SPACE ONLY  -->
					</span>
				</div>

				<div class="form-group col-sm-6">
					<div class="alert alert-danger" role="alert" style="border-radius: 10px;">
						<center> لم يتم التسجيل </center>
					</div>
				</div>

				<div class="form-group col-sm-3">
					<span>
						<!-- SPACE ONLY  -->
					</span>
				</div>
			</div>

			<div class="modal MyModal" role="dialog" id="RegistrationLawerModel" style="">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<div class="modal-title" style="">
								<h3 class="modal_header" style="">
									 انضم كمحامي 
								</h3>
							</div>
						</div>
						<div class="modal-body" style="min-height: 600px;">
							<center>
								<div class="alert alert-danger" style="visibility:collapse;display: none;border-radius: 10px;" id="errorLabel" style=""> </div>
							</center>
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
											<select class="registration-input" name="QualificationID" id="QualificationID">
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
											<select class="registration-input" name="LicenseType" id="LicenseType">
												<option value="-1">-- اختر نوع الرخصة --</option>
												<option value="1">مرخص </option>
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
											<select class="registration-input" name="Experience" id="Experience">
												<option value="-1">الخبرة</option>
												<?php
												for ($i = 1; $i <= 50; $i++) {
													echo "<option value=" . $i . ">" . $i . "</option>";
												} //END for($i=1;$i<=50;$i++)
												?>
											</select>
											<i class="fa fa-level-up-noneed fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="number" class="registration-input" name="LawyerAccountID" id="LawyerAccountID" placeholder="رقم الحساب">
											<i class="fa fa-user-nodeed fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<select class="registration-input" name="FieldID" id="FieldID">
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
											<input type="email" class="registration-input" name="Email" id="Email" placeholder="البريد">
											<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="tel" class="registration-input" name="PhoneNumber" id="PhoneNumber" placeholder="الجوال">
											<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="password" class="registration-input" name="Password" id="Password" placeholder="كلمة المرور">
											<i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="terms_and_conditions" target="_blank">الشروط والأحكام</a>
								<div class="row">
									<div class="col-md-12">
										<input type="checkbox" class="" value="1" onclick="lawyer_terms_changed(this)" name="LawyerAcceptTerms" id="LawyerAcceptTerms"> موافق على الشروط والأحكام
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button id="SaveLawyer" disabled  class="btn btn-primary button" type="button" onclick="return validation('LawyerForm');">تسجيل</button></center>
									</div>
									<div class="col-md-4"></div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button type="button" class="btn btn-primary button" style="width: 100px; background-color: gray; border-color:white; " data-dismiss="modal" onclick="Close(1);">إغلاق  </button></center>
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

			<div class="modal MyModal" role="dialog" id="RegistrationCompanyModel" style="display: none;">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<div class="">
								<div class="modal-title" style="text-align: center;">
									<h3>
										<center> انضم كشركة أو مكتب محاماة </center>
									</h3>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<center>
								<div class="alert alert-danger" style="visibility:collapse;display: none;border-radius: 10px;" id="ProviderErrorLabel" style=""> </div>
							</center>
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
											<select class="registration-input" name="ProviderType" id="ProviderType">
												<option value="-1">-- اختر النوع --</option>
												<option value="1"> شركة </option>
												<option value="2"> مكتب </option>
											</select>
											<i class="fa fa-car-noneed fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<select class="registration-input" name="ProviderCityID" id="ProviderCityID">
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
											<input type="email" class="registration-input" name="ProviderEmail" id="ProviderEmail" placeholder="البريد">
											<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="tel" class="registration-input" name="ProviderPhoneNumber" id="ProviderPhoneNumber" placeholder="الجوال">
											<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="password" class="registration-input" name="ProviderPassword" id="ProviderPassword" placeholder="كلمة المرور">
											<i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="text" class="registration-input" name="ProviderAccountID" id="ProviderAccountID" placeholder="رقم الحساب">
											<!-- <i class="fa fa-money fa-lg fa-fw" aria-hidden="true"></i> -->
										</div>
									</div>
								</div>
								<a href="terms_and_conditions" target="_blank">الشروط والأحكام</a>
								<div class="row">
									<div class="col-md-12">
										<input type="checkbox" class="" value="1" onclick="provider_terms_changed(this)" name="LawyerAcceptTerms" id="LawyerAcceptTerms"> موافق على الشروط والأحكام
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button id="SaveCompany" disabled class="btn btn-primary button" type="submit" onclick="return validation('CompanyForm');">تسجيل</button></center>
									</div>
									<div class="col-md-4"></div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button type="button" class="btn btn-primary button" style="width: 100px; background-color: gray;" data-dismiss="modal" onclick="Close(2);">إغلاق  </button></center>
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
							<div class="">
								<div class="modal-title" style="text-align: center;">
									<h3>
										<center> انضم كعميل </center>
									</h3>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<center>
								<div class="alert alert-danger" style="visibility:collapse;display: none;border-radius: 10px;" id="CustomerErrorLabel" style=""> </div>
							</center>
							<form method="post" name="CustomerForm" id="CustomerForm" onsubmit="return validation('CustomerForm');" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="text" class="registration-input" name="CustomerFirstName" id="CustomerFirstName" placeholder="الأسم الأول">
											<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="text" class="registration-input" name="CustomerLastName" id="CustomerLastName" placeholder="الأسم الأخير">
											<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="email" class="registration-input" name="CustomerEmail" id="CustomerEmail" placeholder="البريد">
											<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="tel" class="registration-input" name="CustomerPhoneNumber" id="CustomerPhoneNumber" placeholder="الجوال">
											<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-4">
										<div class="Icon-inside">
											<input type="password" class="registration-input" name="CustomerPassword" id="CustomerPassword" placeholder="كلمة المرور">
											<i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
										</div>
									</div>
								</div>
								<a href="lawyer_login_form" >إذا  كنت تملك حساب مسبقا يمكن تسجيل الدخول </a>
								<br>
								<a href="terms_and_conditions" target="_blank">الشروط والأحكام</a>
								<div class="row">
									<div class="col-md-12">
										<input type="checkbox" class="" value="1" onclick="customer_terms_changed(this)" name="LawyerAcceptTerms" id="LawyerAcceptTerms"> موافق على الشروط والأحكام
									</div>
								</div>
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button id="SaveCustomer" disabled class="btn btn-primary button" type="submit" onclick="return validation('CustomerForm');">تسجيل</button></center>
									</div>
									<div class="col-md-4"></div>
								</div>
								<div class="row" style="margin-top: 10px;">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<center><button type="button" class="btn btn-primary button" style="width: 100px; background-color: gray;" data-dismiss="modal" onclick="Close(3);">إغلاق </button></center>
									</div>
									<div class="col-md-4"></div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="services-section" id="services-section" style="">
			<div class="container-fluid">
				@if($Services->Count() > 0)
				<center>
					<h1> الخدمات القانونية </h1>
				</center>
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
								<center>
									<button id="Update" class="btn btn-secondary button" style="width:70%; margin:0 auto;margin-top: 7px; border-radius: 12px; background-color: white;max-height: ; border-color:#06BBCC; border-width: 2px;  color: #06BBCC"> {{$Service->ServiceName}}  </button>
								</center>
							</div>
							<div class="card-body" style="padding: 1rem 0rem;">
								<img src="{{asset($Service->ServiceImage)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
								<div class="row" style="display: none;">
									<div class="col align-self-start">
										<div class="" style="text-align: ;"> نوع الخدمة <br> {{$ServiceTypeName}} </div>
									</div>
									<div class="col align-self-center">

									</div>
									<div class="col align-self-end">
										<div class="Icon-inside" style="margin-left: 15px; text-align: left;">
											<div class="product_price" style="text-align:;"> السعر <br>
												<div class="number" style="margin: 0 auto; text-align: center;"> {{$Service->ServicePrice}} SR </div>
											</div>
										</div>
									</div>
								</div>
								<center>
									<button id="Update" class="btn btn-secondary button" style="width:60%; margin:0 auto;margin-top: -17px; border-radius: 25px; background-color: gray;max-height: ; border-width: 2px;  color: white"> وصف الخدمة   </button>
								</center>
								<center><div style="max-height: 90px;min-height: 90px;">{{$Service->ServiceDetails}} </div></center>
							</div>
							<form id="OrderForm" name="OrderForm">
								@csrf
								<input type="hidden" name="CustomerID" id="CustomerID" value="{{$CustomerID}}">
							</form>
							<div class="card-footer" style="border-top: 0px;">
								<center>
									<a href="customers/custome_order/{{$Service->ServiceID}}" target="_blank" class="btn btn-primary " style="width:60%; margin:0 auto;margin-top: -17px; border-radius: 25px; background-color: gray;max-height: ; border-width: 2px;  color: white" onclick="return chek_session({{$Service->ServiceID}});">
									طلب الخدمة 
									</a>
								</center>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@endif
				<br>
				<center>
					<a href="services" class="show_all " target="_blank" style="">كل الخدمات</a>
				</center>
			</div>
		</section>

		<section class="courses-section" id="courses-section" style="display: none;">
			<div class="container-fluid">
				@if($Courses->Count() > 0)
				<center>
					<h1> الدورات المتاحة </h1>
				</center>
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
								$CourseTypeName = "حضوري ";
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
										<div class="" style="text-align:center; ;"> نوع الدورة <br> {{$CourseTypeName}} </div>
									</div>
									<div class="col align-self-center"></div>
									<div class="col align-self-end">
										<div class="Icon-inside" style="">
											<!-- <i class="fa fa-clock-o fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 60px;"></i> -->
											<div class="CourseHours" style=""> عدد الساعات <br>
												<div class="number" style=""> {{$Course->CourseHours}} ساعة
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col align-self-start">
										<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;" src="{{asset($CoursePresenterImage)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
										<div class="CourseDetails" style="min-width: 100px; width: 200px;"> {{$Course->CoursePresenter}}</div>
									</div>
									<div class="col align-self-center"></div>
									<div class="col align-self-end">
										تاريخ الدورة
										<div class="CourseDetails" style=""> {{$Course->CourseDate}}</div>
									</div>
								</div>
								<div class="row" style="display: none;">

									<div class="col align-self-start" style="display: none;">
										<img style="border-radius: 50%; border: 0.1rem solid rgb(128,128,128);width: 5rem;height: 5rem;" src="{{asset($CourseLogo)}}" width="50px" height="50px" class="card-img-top img-circle" alt="...">
									</div>
									<div class="col align-self-center"></div>
									<div class="col align-self-end">
										<div class="CourseDetails" style="min-width: 100px; width: 200px;"> {{$Course->CoursePresenter}}</div>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<a href="http://www.{{$Course->CourseLink}}" target="_blank" class="btn btn-primary service_btn" style="width: 100%; ">
									<h3> رابط الدورة </h3>
								</a>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<br>
				<center>
					<a href="courses" class="show_all" target="_blank" style="">كل الدورات</a>
				</center>
				@endif
			</div>
		</section>

		<section class="library-section" id="library-section" style="display: none;">
			<div class="container-fluid">
				@if($Libraries->Count() > 0)
				<center>
					<h1> المكتبة القانونية </h1>
				</center>
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
					<div class="col-md-4 ">
						<div class="card service_card">
							<div class="card-header">
								<img src="{{asset($StaticImages)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
								<center>{{$Library->Title}}</center>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col align-self-start">
										<div class="" style="text-align: left;"> النوع <br> {{$SubjectTypeName}} </div>
									</div>
									<div class="col align-self-center"></div>
									<div class="col align-self-end" style="">
										<div class="Icon-inside" style="margin-left: 15px; text-align: right;">
											<div class="product_price" style="text-align:;"> المجال <br>
												<div class="number" style="margin: 0 auto; text-align: right;"> {{$Library->fields->FieldName}} </div>
											</div>
										</div>
									</div>
								</div>
								<hr style="height: 5px;width: 100%;">
								<div class="row">
									<div  class="col align-self-start">
										<div class="" style="max-width: 230px;min-width: 230px;"> الكاتب <br> {{$Library->Author}} </div>
									</div>
									<div class="col align-self-end" style="text-align: left;">
										<div class="" style=""> تاريخ النشر <br> {{$Library->FromDate}} </div>

									</div>
								</div>
							</div>
							<div class="card-footer" style="display: none;">
								<a href="order/{{$Service->ServiceID}}" class="btn btn-primary service_btn" style="width: 100%;">
									<h3> فتح المقال </h3>
								</a>

							</div>
						</div>
					</div>
					@endforeach
				</div>
			<center>
				<a href="libraries" class="show_all" target="_blank" style="">كل المقالات</a>
			</center>

				@endif
			</div>

		</section>



		<section class="search-section" style="display: none;">
			<div class="container">
				<center>
					<h1>
						البحث عن محامي
					</h1>
				</center>
				<br>
				<div class="card searchcard">
					<div class="search-aria">
						<form action="search-result" target="_blank" method="post" class=" form-inline" id="SearchForm" name="SearchForm">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="Icon-inside">
										<input type="text" class="registration-input" name="SearchText" id="SearchText" placeholder=" إسم المحامي ">
										<button type="submit" style="background-color: weight; outline-color: weight;" class="btn"><i class="fa fa-search fa-lg fa-fw" type="submit" name="Search" id="Search" style="color: #1198B6;align-items: center;top: 6px; " aria-hidden="true"></i> </button>
									</div>
								</div>
							</div>

							<div class="row advanced-search">
								<div class="col-md-3">
									<div class="Icon-inside">
										<select class="registration-input" name="CityID" id="CityID">
											<option value="-1">اختر المدينة</option>
											@foreach($Cities as $City)
											<option value="{{$City->CityID}}">{{$City->CityName}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-3">
									<div class="Icon-inside">
										<select class="registration-input" name="FieldID" id="FieldID">
											<option value="-1">اختر المجال </option>
											@foreach($Fields as $Field)
											<option value="{{$Field->FieldID}}">{{$Field->FieldName}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-3">
									<div class="Icon-inside">
										<select class="registration-input" name="LicenseType" id="LicenseType">
											<option value="-1"> اختر نوع الرخصة </option>
											<option value="1">مرخص </option>
											<option value="2"> متدرب </option>
										</select>
									</div>
								</div>

								<div class="col-md-3">
									<div class="Icon-inside">
										<select class="registration-input" name="Experience" id="Experience">
											<option value="-1">الخبرة</option>
											<?php
											for ($i = 1; $i <= 50; $i++) {
												echo "<option value=" . $i . ">" . $i . "</option>";
											} //END for($i=1;$i<=50;$i++)
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
			function Registration(RegistrationType) {
				//alert("Montasir");
				//alert(RegistrationType);
				if (RegistrationType == 1) {
					//alert("Montasir IN");
					$("#RegistrationLawerModel").css("display", "block");
					/*$(".modal-dialog").css("display","block");
					$(".modal-content").css("display","block");
					$(".modal-body").css("display","block"); */
				} //END  if(RegistrationType == 1)
				else if (RegistrationType == 2) {
					$("#RegistrationCompanyModel").css("display", "block");
					/*$(".modal-dialog").css("display","block");
					$(".modal-content").css("display","block");
					$(".modal-body").css("display","block");*/
				} //END  if(RegistrationType == 2)
				else if (RegistrationType == 3) {
					$("#RegistrationCustomerModel").css("display", "block");
					/*$(".modal-dialog").css("display","block");
					$(".modal-content").css("display","block");
					$(".modal-body").css("display","block");*/
				} //END  if(RegistrationType == 3)

			} //END function CheckLogin()

			function Close(RegistrationType) {
				// alert(RegistrationType);
				if (RegistrationType == 1) {
					$("#RegistrationLawerModel").css("display", "none");
				} //END  if(RegistrationType == 1)
				else if (RegistrationType == 2) {
					$("#RegistrationCompanyModel").css("display", "none");
				} //END  if(RegistrationType == 2)
				else if (RegistrationType == 3) {
					$("#RegistrationCustomerModel").css("display", "none");
				} //END  if(RegistrationType == 3)
				else if (RegistrationType == 4) {
					$("#ServiceModel").css("display", "none");
				} //END  if(RegistrationType == 4)

			} //END function Close()
		</script>


		<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>

		<script>
			function chek_session(ServiceID) {
				CustomerID = document.getElementById("CustomerID").value;
				// alert(CustomerID);
				// alert(ServiceID);
				if(CustomerID == 0) {
					$("#RegistrationCustomerModel").css("display", "block");
					return false;
				}//END if(CustomerID == 0)
				else if(CustomerID > 0) {
					window.reload("customers/order/ServiceID");
				}//END else if(CustomerID > 0)
			}//END function chek_session()
		</script>

		<script>
			function validation(FormName) {
				if (FormName == "LawyerForm") {					
					// alert("Montassssssssssssssir");
					var FirstName = document.getElementById("FirstName").value;
					var LastName = document.getElementById("LastName").value;
					var Specialism = document.getElementById("Specialism").value;
					var Email = document.getElementById("Email").value;
					var PhoneNumber = document.getElementById("PhoneNumber").value;
					var LawyerAccountID = document.getElementById("LawyerAccountID").value;
					var Password = document.getElementById("Password").value;
					var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
					var atposition=Email.indexOf("@");  
					var dotposition=Email.lastIndexOf(".");
					
					if (FirstName.length < 2 || FirstName.length > 20 ) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["FirstName"].focus();
						return false;
					}
					if (LastName.length < 2 || LastName.length > 20 ) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["LastName"].focus();
						return false;
					}
					if (document.forms["LawyerForm"].elements["QualificationID"].value == -1) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["QualificationID"].focus();
						return false;
					}
					if (Specialism.length < 2) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["Specialism"].focus();
						return false;
					}
					if (document.forms["LawyerForm"].elements["LicenseType"].value == -1) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["LicenseType"].focus();
						return false;
					}
					if (document.forms["LawyerForm"].elements["Experience"].value == -1) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["Experience"].focus();
						return false;
					}
					if(LawyerAccountID.length != 10) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "رقم الحساب غير صحيح "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["LawyerAccountID"].focus();
						return false;
					}//END if(LawyerAccountID.length != 10)
					if (document.forms["LawyerForm"].elements["FieldID"].value == -1) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["FieldID"].focus();
						return false;
					}
					if (atposition<1 || dotposition<atposition+2 || dotposition+2>=Email.length) {
						document.getElementById('errorLabel').innerHTML = "<?php echo " يجب إدخال بريد صحيح  "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["Email"].focus();
						return false;
					}
					if (PhoneNumber.length != 10) {
						document.getElementById('errorLabel').innerHTML = "<?php echo " رقم الجوال غير صحيح  "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["PhoneNumber"].focus();
						return false;
					}
					if (Password.length <= 7) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "كلمة المرور يجب أن تتكون من 8 خانات على الأقل "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["LawyerForm"].elements["Password"].focus();
						return false;
					}
					else {
						document.getElementById('errorLabel').style.visibility = 'collapse';
					}
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
		} //END if(FormName == "LawyerForm")

			else if (FormName == "CompanyForm") {
				// alert("CompanyForm");
					var ProviderName = document.getElementById("ProviderName").value;
					var Address = document.getElementById("Address").value;
					var Email = document.getElementById("ProviderEmail").value;
					var PhoneNumber = document.getElementById("ProviderPhoneNumber").value;
					var ProviderAccountID = document.getElementById("ProviderAccountID").value;
					var Password = document.getElementById("ProviderPassword").value;
					var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
					var atposition=Email.indexOf("@");  
					var dotposition=Email.lastIndexOf(".");
				if (ProviderName.length <=  5) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderName"].focus();
					return false;
				}
				if (document.forms["CompanyForm"].elements["ProviderType"].value == -1) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "الرجاء إختيار النوع"; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderType"].focus();
					return false;
				}
				if (document.forms["CompanyForm"].elements["ProviderCityID"].value == -1) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "الرجاء إختيار المدينة  "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderCityID"].focus();
					return false;
				}
				if (Address.length <= 20) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["Address"].focus();
					return false;
				}
				if (document.forms["CompanyForm"].elements["LicensePath"].value == '') {
					// alert("Montassssssssssssssir");
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "يجب إرفاق الرخصة  "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["LicensePath"].focus();
					return false;
				}
				if (atposition<1 || dotposition<atposition+2 || dotposition+2>=Email.length ) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo " البريد غير صحيح  "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderEmail"].focus();
					return false;
				}
				if (PhoneNumber.length != 10) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo " رقم الجوال غير صحيح   "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderPhoneNumber"].focus();
					return false;
				}
				if (Password.length <= 7) {
					document.getElementById('ProviderErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
					document.getElementById('ProviderErrorLabel').style.visibility = 'visible';
					document.getElementById('ProviderErrorLabel').style.display = 'block';
					document.forms["CompanyForm"].elements["ProviderPassword"].focus();
					return false;
				}
				if(ProviderAccountID.length != 10) {
						document.getElementById('errorLabel').innerHTML = "<?php echo "رقم الحساب غير صحيح "; ?>";
						document.getElementById('errorLabel').style.visibility = 'visible';
						document.getElementById('errorLabel').style.display = 'block';
						document.forms["CompanyForm"].elements["ProviderAccountID"].focus();
						return false;
					}//END if(LawyerAccountID.length != 10)
				else {
					document.getElementById('ProviderErrorLabel').style.visibility = 'collapse';
				}
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

			} //END if(FormName == "CompanyForm")
				else if (FormName == "CustomerForm") {
					// alert("CompanyForm");
					var FirstName = document.getElementById("CustomerFirstName").value;
					var LastName = document.getElementById("CustomerLastName").value;
					var Email = document.getElementById("CustomerEmail").value;
					var PhoneNumber = document.getElementById("CustomerPhoneNumber").value;
					var Password = document.getElementById("CustomerPassword").value;
					var mailformat = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
					var atposition=Email.indexOf("@");  
					var dotposition=Email.lastIndexOf(".");
					if (FirstName.length <= 1 || FirstName.length > 20) {
						document.getElementById('CustomerErrorLabel').innerHTML = "<?php echo " الأسم  الأول غير صحيح "; ?>";
						document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
						document.getElementById('CustomerErrorLabel').style.display = 'block';
						document.forms["CustomerForm"].elements["CustomerFirstName"].focus();
						return false;
					}
					if (LastName.length <= 1 || LastName.length > 20) {
						document.getElementById('CustomerErrorLabel').innerHTML = "<?php echo " الأسم الأخير غير صحيح  "; ?>";
						document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
						document.getElementById('CustomerErrorLabel').style.display = 'block';
						document.forms["CustomerForm"].elements["CustomerLastName"].focus();
						return false;
					}
					if (atposition<1 || dotposition<atposition+2 || dotposition+2>=Email.length) {
						document.getElementById('CustomerErrorLabel').innerHTML = "<?php echo " البريد غير صحيح  "; ?>";
						document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
						document.getElementById('CustomerErrorLabel').style.display = 'block';
						document.forms["CustomerForm"].elements["CustomerEmail"].focus();
						return false;
					}
					if (PhoneNumber.length != 10) {
						document.getElementById('CustomerErrorLabel').innerHTML = "<?php  echo " رقم الجوال غير صحيح  "; ?>";
						document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
						document.getElementById('CustomerErrorLabel').style.display = 'block';
						document.forms["CustomerForm"].elements["CustomerPhoneNumber"].focus();
						return false;
					}
					if (Password.length <= 7) {
						document.getElementById('CustomerErrorLabel').innerHTML = "<?php  echo "الحقل مطلوب "; ?>";
						document.getElementById('CustomerErrorLabel').style.visibility = 'visible';
						document.getElementById('CustomerErrorLabel').style.display = 'block';
						document.forms["CustomerForm"].elements["CustomerPassword"].focus();
						return false;
					} 
					else {
						document.getElementById('CustomerErrorLabel').style.visibility = 'collapse';
					}
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
						} //END if (data.status == true)
						else {
							$("#DangerMessage").show();
							setTimeout(function() {
								$("#DangerMessage").hide();
							}, 5000);

						} //END else

					},
					error: function(reject) {

						var response = $.parseJSON(reject.responseText);

						$.each(response.errors, function(key, val) {

							$("#" + key + "_error").text(val[0]);
						});

					}
				});
			});
		} //END if(FormName == "CompanyForm")
	} //END function validation()

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
						} //END if (data.status == true)
						else {
							$("#DangerMessage").show();
							setTimeout(function() {
								$("#DangerMessage").hide();
							}, 5000);

						} //END else

					},
					error: function(reject) {

						var response = $.parseJSON(reject.responseText);

						$.each(response.errors, function(key, val) {

							$("#" + key + "_error").text(val[0]);
						});

					}
				});
			});

			function Service(ServiceID) {
				// alert(ServiceID);
				$("#ServiceModel").css("display", "block");
			} //END function Service(ServiceID)
		</script>
		<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
		<script>
			
	

	function lawyer_terms_changed(termsCheckBox){
        if(termsCheckBox.checked){
	        //Set the disabled property to FALSE and enable the button.
	        document.getElementById("SaveLawyer").disabled = false;
	    } else{
	        //Otherwise, disable the submit button.
	        document.getElementById("SaveLawyer").disabled = true;
	    }
	}//END function lawyer_terms_changed(termsCheckBox)

	function provider_terms_changed(termsCheckBox){
        if(termsCheckBox.checked){
	        //Set the disabled property to FALSE and enable the button.
	        document.getElementById("SaveCompany").disabled = false;
	    } else{
	        //Otherwise, disable the submit button.
	        document.getElementById("SaveCompany").disabled = true;
	    }
	}//END function provider_terms_changed(termsCheckBox)

	function customer_terms_changed(termsCheckBox){
        if(termsCheckBox.checked){
	        //Set the disabled property to FALSE and enable the button.
	        document.getElementById("SaveCustomer").disabled = false;
	    } else{
	        //Otherwise, disable the submit button.
	        document.getElementById("SaveCustomer").disabled = true;
	    }
	}//END function customer_terms_changed(termsCheckBox)

		</script>