<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>tekkeh</title>
     <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/img/tekkeh.ico')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/fontawesome.min.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/font/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables/datatable.css')}}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">

</head>
<body>

<div class="container row mx-auto align-items-center">
 <div class="header-container container" style="margin-top: 0px;">
  <div class="gradient-bg"></div> 

<div style="padding-top: 35px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">


    <center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style="width: 50%; margin: 0 auto;"> </div></center>
<div class="card logincard">
<center>
    <img class="rounded-circle" src="{{asset('public/assets/img/login.png')}}" style="margin-bottom: 15px; margin-top: 10px;">
</center>
    <form method="POST"  id="login_form" name="login_form" enctype="multipart/form-data" onsubmit="return validation();">  
        @csrf

        <div class="row">
            <div class="form-group col-sm-4">
                <span><!-- SPACE ONLY  --></span>
            </div>

            <div class="form-group col-sm-4">
                <input class="registration-input"type="text" name="user_name"  placeholder="إسم الدخول"
                 value="">  

                 <small id="user_name_error" class="form-text text-danger" style="text-align: right;"></small>
                 
            </div>
            <div class="form-group col-sm-3">
                <div><!-- SPACE ONLY --></div>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-sm-4">
                <span><!-- SPACE ONLY  --></span>
            </div>

            <div class="form-group col-sm-4">
                <input class="registration-input" type="password" name="user_password"  placeholder="كلمة المرور"
                 value="">  
                 <small id="user_password_error" class="form-text text-danger" style="text-align: right;"></small>
                 
            </div>
            <div class="form-group col-sm-4">
                <div><!-- SPACE ONLY --></div>
            </div>
        </div>



        <center>
 <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:100px;"> دخول   </button>                 
    </center>

    <br><br>


    <div class="row" id="wrong_msg" style="display: none;">
    <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>

    <div class="form-group col-sm-6">
        <div class="alert alert-danger" role="alert">
            خطأ في بيانات الدخول
        </div>
    </div>

    <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>


</div>

</form>
</div>


    <script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/main.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/bootstrap5-1-3.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/datatables/datatable.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/datatables/datatable2.js') }}"></script>
</body>
</html>
    <script>
        function validation() {
            if(document.forms["login_form"].elements["user_name"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال إسم الدخول"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["login_form"].elements["user_name"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["login_form"].elements["user_password"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء كتابة كلمة المرور"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["login_form"].elements["user_password"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
        }//END function validation()
    </script>
<script>
    
    $(document).on('click','#save_data', function(e){
            e.preventDefault();

     
            // $('#user_password_error').text('');       


            var form_data = new FormData($('#login_form')[0]);

            $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('user_login')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data){
                // alert(data.status);
                if(data.status == true){
                    window.location=data.url;
                    // alert("Montasir Yeeeeees");
                }
                else{
                    $("#wrong_msg").show();
                }
                
            },
            error: function(reject){

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors,function(key,val){

                    $("#" + key + "_error").text(val[0]);
                });

            }
    });




    });
</script>
