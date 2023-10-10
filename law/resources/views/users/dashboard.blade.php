@extends('layout.admin.master')

@section('content')

	<div class="container row mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
	 		<div class="container-fluid" style="margin-bottom: 5%; margin-top: 2%;">
	 			<div class="row g-2">
	 				<div class="row">
	 					<div class="col-md-4 ">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> الخدمات   </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['Services']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer" style="">
									<a href="services" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> الدورات   <i class="fa fa-book fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 3px;"></i> </h1></center>
								</div>
								<div class="card-body" style="background-color: #f6f6f6;">
									<center><h1>{{$Counts['Courses']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="courses" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> المكتبة  </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['Libraries']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="posts" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 				</div>
	 				<br>
	 				<hr style="width: 96%; margin: 10 auto; height: 2px; background-color: #1198B6;">
	 				<div class="row">
	 					<div class="col-md-4 ">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> الطلبات   </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['AllOrders']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer" style="">
									<a href="show_orders" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> العروض    <i class="fa fa-book fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 3px;"></i> </h1></center>
								</div>
								<div class="card-body" style="background-color: #f6f6f6;">
									<center><h1>{{$Counts['Offers']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="show_offers" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> المستخدمين  </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['Users']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="users" class="" target="_blank" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 				</div>
	 				<br>
	 				<hr style="width: 96%; margin: 10 auto; height: 2px; background-color: #1198B6;">
	 				<div class="row">
	 					<div class="col-md-4 ">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> المحامين  </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['Lawyers']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer" style="">
									<a href="{{ URL::to('admin/lawyers') }}" class=""  style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> مكاتب المحاماة  <i class="fa fa-book fa-lg fa-fw" aria-hidden="true" style="top: -5px;color: #1198B6;margin-right: 3px;"></i> </h1></center>
								</div>
								<div class="card-body" style="background-color: #f6f6f6;">
									<center><h1>{{$Counts['Providers']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="{{ URL::to('admin/providers') }}" class="" style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 					<div class="col-md-4">
	 						<div class="card service_card" style="padding: 0px;">
								<div class="card-header" style="background-color: orange;border-radius: 10px;">
									<center><h1> العملاء  </h1></center>
								</div>
								<div class="card-body">
									<center><h1>{{$Counts['Customers']}}</h1></center>
								</div>
								<div class="card-footer dash-card-footer">
									<a href="{{ URL::to('admin/customers') }}" class=""  style=""><center><h3> التفاصيل </h3></center></a> 
								</div>
							</div>
	 					</div>
	 				</div>

	 			</div>
	 		</div>
	 	</div>
	</div>

@endsection
