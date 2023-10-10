@extends('layout.main_master')
@section('content')
	<div class="container-fluid row mx-auto align-items-center">
		<div class="header-container container-fluid">
	 		<div class="gradient-bg"></div> 
	 			<div class="container-fluid" style="margin-bottom: 5%; margin-top: 2%;">
	 				<section class="library-section" id="library-section" style="">
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
							<div class="col-md-12 ">
								<div class="card service_card" style="padding-bottom: 0px;">
					    		<div class="card-header">
					    			<div class="row">
					    				<div class="col-md-4">
							    			<img src="{{asset($StaticImages)}}" width="100%" height="250px" class="card-img-top img-circle" alt="...">
							    		</div>
							    		<div class="col-md-8">
							    			<div class="content" style="justify-content: center;">
							    				<center><u>{{$Library->Title}}</u> </center>
                								<?php
                									echo $Library->Content;
                								?>
                							</div>
							    		</div>
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
                					 <div class="row">
                						<div class="col align-self-start">
                							<div class="" style="text-align: left;"> الكاتب  <br> {{$Library->Author}} </div>	
                						</div>
                						<div class="col align-self-center"></div>
                						<div class="col align-self-end" style="text-align: right;">
                							<div class="" style=""> تاريخ النشر  <br> {{$Library->FromDate}} </div>	

                						</div>
                					</div>
                					@php
                						if(!empty($Library->documents)) {
                							$Counter = 0;
                							foreach($Library->documents as $LibraryDocument) {
                								//var_dump($LibraryDocument);
                								$Counter = $Counter +1;
                							@endphp
                								<div class="row">
			                						<div class="col align-self-start"></div>
			                						<div class="col align-self-center">
			                							<a href="{{$LibraryDocument['LegislationDocumentPath']}}" target="_blank">الوثيقة  رقم   {{$Counter}}</a>
			                						</div>
			                						<div class="col align-self-end"></div>
			                					</div>
                							@php
                							}//END foreach($Library->documents as $LibraryDocument)


                						}//END if(!empty($Library->documents))
                					@endphp
							    </div>
					  		</div>
							</div>
						<!-- <hr style="height: 3px;width: 100%;" > -->
						@endforeach
					</div>

						@endif
					</div>
</section>
	 			</div>
	 	</div>
	</div>

@endsection