@extends('layout.main_master')

@section('content')

<div class="container row mx-auto align-items-center">
 <div class="header-container container" style="margin-top: 50px;">
  <div class="gradient-bg"></div> 
	<form method="post" name="UserForm" id="UserForm" onsubmit="return validation('CustomerForm');" enctype="multipart/form-data">
        	 	@csrf
        	 	<div class="row">
        	 		<div class="col-md-12">
        	 			<center>
								<div class="alert alert-danger" style="visibility:collapse;display: none;" id="ErrorLabel" style=""> </div>
							</center>
        	 		</div>
        	 	</div>
				<div class="row">
					<div class="col-md-4"></div>
				  	<div class="col-md-4">
				      <div class="Icon-inside">
				        <input type="text" class="registration-input" name="FullName" id="FullName" placeholder="الإسم">
				        <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
				      </div>
				  	</div>
				  <div class="col-md-4"></div>
				</div>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="Icon-inside">
							<input type="email"  class="registration-input" name="Email" id="Email" placeholder="البريد">
							<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
						</div>
				  	</div>
				  	<div class="col-md-4"></div>
				  </div>
				  	<div class="row">
				  		<div class="col-md-4"></div>
					  	<div class="col-md-4">
						      <div class="Icon-inside">
						        <input type="tel"  class="registration-input" name="PhoneNumber" id="PhoneNumber" placeholder="الجوال">
						        <i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
						      </div>
						</div>
						<div class="col-md-4"></div>
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
					      <div class="Icon-inside">
					        <input type="password"  class="registration-input" name="Password" id="Password" placeholder="كلمة المرور">
					        <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
					      </div>
					  	</div>
					  	<div class="col-md-4"></div>
			  		</div>
			  
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<center><button id="SaveUser" class="btn btn-primary button" type="submit" onclick="return validation();">حفظ</button></center>
				</div>
				<div class="col-md-4"></div>
			</div>

		<br>
		<div class="row" id="SuccessMessage" style="display: none;">
			<div class="form-group col-sm-3">
				<span><!-- SPACE ONLY  --></span>
			</div>

			<div class="form-group col-sm-6">
				<div class="alert alert-success" role="alert">
					<center> تم  الحفظ بنجاح  </center>
				</div>
			</div>

			<div class="form-group col-sm-3">
				<span><!-- SPACE ONLY  --></span>
			</div>
		</div>
		</form>
		@if($Users->Count() > 0)
			<div class="ShowCard card ">
				<div class="table-responsive">
					<table id="myTable" class="table table-striped" style="width:90%" align="center">
						<thead>
		            		<tr>
		       					<td align="center"><b>#</b></td>
		       					<td align="center"><b>الإسم  </b></td>
		       					<td align="center"><b>البريد  </b></td>
		       					<td align="center"><b>الجوال   </b></td>
		       					<td align="center"><b>عرض   </b></td>

		       				</tr>
		       			</thead>
		       			<tbody>
		       				@php
		       					$Counter = 0;
		       				@endphp
		       				@foreach($Users as $User)
		       					@php
		       						$Counter = $Counter+1;
		       					@endphp
		       					<tr>
		       						<td align="center">{{$Counter}}</td>
		       						<td align="center">{{$User->FullName}}</td>
		       						<td align="center">{{$User->Email}}</td>
		       						<td align="center">{{$User->PhoneNumber}}</td>
		       						<td align="center"><a href="{{route('show_user',$User->UserID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> عرض </a></td>
		       					</tr>
		       				@endforeach
		       			</tbody>
						
					</table>
				</div>
			</div>
		@endif

	</div>
</div>


@endsection


<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
		function validation() {
			// alert("Save");
			if (document.forms["UserForm"].elements["FullName"].value == '') {
				document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
				document.getElementById('ErrorLabel').style.visibility = 'visible';
				document.getElementById('ErrorLabel').style.display = 'block';
				document.forms["UserForm"].elements["FullName"].focus();
				return false;
			}
			if (document.forms["UserForm"].elements["Email"].value == '') {
				document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
				document.getElementById('ErrorLabel').style.visibility = 'visible';
				document.getElementById('ErrorLabel').style.display = 'block';
				document.forms["UserForm"].elements["Email"].focus();
				return false;
			}
			if (document.forms["UserForm"].elements["PhoneNumber"].value == '') {
				document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
				document.getElementById('ErrorLabel').style.visibility = 'visible';
				document.getElementById('ErrorLabel').style.display = 'block';
				document.forms["UserForm"].elements["PhoneNumber"].focus();
				return false;
			}
			if (document.forms["UserForm"].elements["Password"].value == '') {
				document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
				document.getElementById('ErrorLabel').style.visibility = 'visible';
				document.getElementById('ErrorLabel').style.display = 'block';
				document.forms["UserForm"].elements["Password"].focus();
				return false;
			}

			    $(document).on('click', '#SaveUser', function(e) {
        e.preventDefault();
        var form_data = new FormData($('#UserForm')[0]);

        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('add_user')}}",
            data: form_data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)
                    // table.ajax.reload(null, false)
                    // var url = "{{route('show_users')}}";
					// $('#myTable').load(url + '#myTable>');
                    $("#SuccessMessage").show();
                    document.getElementById("UserForm").reset();
                    setTimeout(function() {
                        $("#SuccessMessage").hide();
                        location.reload();
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

		}//END function validation()

</script>


    <script>
    	 $(document).ready(function(){
    $('#myTable').dataTable();
  });

$('#myTable').dataTable( {

    // "language" :{
    //   "info": "MMMM _START_ to _END_ NNN _TOTAL_ KKKK",
    //  }  ,

    "oLanguage": {
      // "aaSorting": [[ 10, "desc" ]],
      // "bJQueryUI": true,
      // "sLengthMenu": [["25", "50", "100", "250", "500", "-1"], ["25", "50", "100", "250", "500", "All"]],
      "sLengthMenu": "عرض  _MENU_ سجلات",
      "sSearch": "بحث: ",
      "sZeroRecords" : "لا توجد بيانات لعرضها",
      "sInfo" : "عدد السجلات  _TOTAL_ , المعروض ( من  _START_ إلى   _END_)",
      "sInfoEmpty" : "", 
    "oPaginate":{
      'sShowing' : "عرض"  ,
      'sNext' : "التالي" ,
      'sPrevious' : 'السابق'  ,
    }
    
    },

});

    </script>