@extends('layout.admin.master') 

@section('content')

<div class="container">

    <div class="row">
                    <div class="col-md-12">
                        <center>
                                <div class="alert alert-danger" style="visibility:collapse;display: none;" id="ErrorLabel" style=""> </div>
                            </center>
                    </div>
                </div>

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">

        <?php $user_data = session()->get('user_data') ?>

    <form method="POST"  id="user_form" enctype="multipart/form-data">  
        @csrf

        <input type="hidden" name="UpdateUserID" id="UpdateUserID" value="{{$update_user->UserID}}">

    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control registration-input"type="text" name="FullName"  value="{{$update_user->FullName}}" placeholder="الإسم"
            value="">  
            <small id="full_name_error" class="form-text text-danger" style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control registration-input"type="text" name="Email" value="{{$update_user->Email}}"  placeholder="البريد "
            value="">  

            <small id="user_name_error" class="form-text text-danger" style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control registration-input" type="password" name="Password"  placeholder=" كلمة المرور"
            value="">  
            <small id="user_password_error" class="form-text text-danger" style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>


<!--  -->
    
    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control registration-input"type="text" name="PhoneNumber" value="{{$update_user->PhoneNumber}}"  placeholder="رقم الهاتف"
            value="">  

            <small id="user_phone_error" class="form-text text-danger"  style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            @php
                //var_dump($update_user);
                $UserStatus = $update_user->Status;
                $UserStatusMessage = "";
                $UserStatusBtnClass = "";
                $UserStatusBtnValue = "";
                if($UserStatus == -2)
                 {
                    $UserStatusMessage = "تم  تفعيل حساب المستخدم " ;
                    $UserStatusBtnClass = "primary";
                    $UserStatusBtnValue = "تفعيل";
                 }//END if($UserStatus == -2)
                 else if($UserStatus == 1)
                 {
                    $UserStatusMessage = "تم تعطيل حساب المستخدم" ;

                    $UserStatusBtnClass = "warning";
                    $UserStatusBtnValue = "تعطيل";
                 }//END if($UserStatus == 1)
                $selected_level1 = "";
                $selected_level2 = "";
                if($update_user->UserType == 1)
                {
                    $selected_level1 = "selected";
                }//END if($update_user->user_level == 1)
                else if($update_user->UserType == 2)
                {
                    $selected_level2 = "selected";
                }//END else if($update_user->UserType == 2)
            @endphp
            <select class="form-control col-xs-3 box registration-input" name="UserType" id="UserType" required style="display: none;">
                <option value="2" <?php echo $selected_level2; ?> > مستخدم </option>
                <option value="1" <?php echo $selected_level1; ?>> مدير </option>
            </select>
            
        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>

    <br>
    <center>
        <button id="save_data" class="btn btn-success button" style="width: 100px;" onclick="return validation();">تعديل   </button>
        <button id="disable_btn" class="btn btn-<?php echo $UserStatusBtnClass ?> button" > <?php echo $UserStatusBtnValue ?>   </button>
        <button id="delete_btn" class="btn btn-danger button" style="width:100px;"> حذف </button> 
    </center>

    <br>
    <div class="row" id="success_msg" style="display: none;">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert">
               <center> تم  التعديل بنجاح</center>
           </div>
       </div>

       <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>

 <br>
    <div class="row" id="success_delete_msg" style="display: none;">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert">
               <center> تم الحذف بنجاح  </center>
           </div>
       </div>

       <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>

<div class="row" id="success_disable_msg" style="display: none;">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert">
               <center> <?php echo $UserStatusMessage; ?> </center>
           </div>
       </div>

       <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>



</form>



</div>





@endsection

<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script>
            function validation() {
            // alert("Save");
            if (document.forms["user_form"].elements["FullName"].value == '') {
                document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
                document.getElementById('ErrorLabel').style.visibility = 'visible';
                document.getElementById('ErrorLabel').style.display = 'block';
                document.forms["user_form"].elements["FullName"].focus();
                return false;
            }
            if (document.forms["user_form"].elements["Email"].value == '') {
                document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
                document.getElementById('ErrorLabel').style.visibility = 'visible';
                document.getElementById('ErrorLabel').style.display = 'block';
                document.forms["user_form"].elements["Email"].focus();
                return false;
            }
            if (document.forms["user_form"].elements["PhoneNumber"].value == '') {
                document.getElementById('ErrorLabel').innerHTML = "<?php echo "الحقل مطلوب "; ?>";
                document.getElementById('ErrorLabel').style.visibility = 'visible';
                document.getElementById('ErrorLabel').style.display = 'block';
                document.forms["user_form"].elements["PhoneNumber"].focus();
                return false;
            }
        $(document).on('click','#save_data', function(e){
            e.preventDefault();

            var form_data = new FormData($('#user_form')[0]);

            $.ajax({
                type: "post",
                enctype : "multipart/form-data",
                url: "{{route('update_user')}}",
                data: form_data,
                processData : false,
                contentType : false,
                cache :false,
                success: function(data){
                    if(data.status == true){
                    // alert(data.msg)
                    
                    $("#success_msg").show();
                    document.getElementById("user_form").reset();
                    setTimeout(function() { $("#success_msg").hide(); }, 2000);
                    window.setTimeout(function(){
                        window.location.href = "{{route('show_users')}}";
                        }, 5000);
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

}
</script>



<script type="text/javascript">
    $(document).on('click','#delete_btn', function(e){
            e.preventDefault();
            var user_id = document.getElementById("UpdateUserID").value;
            // alert(user_id);
            $.ajax({
            type: "post",
            url: "{{route('delete_user')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id'     : user_id,
            },
            success: function(data){
                if(data.status == true){
                    // alert(data.msg)
                    $('#success_delete_msg').show();
                    document.getElementById("user_form").reset();
                    setTimeout(function() { $("#success_msg").hide(); }, 2000);
                    window.setTimeout(function(){
                    window.location.href = "{{route('show_users')}}";
                    }, 5000);

                    // $('.user_row'+user_id).remove();
                }

                

            }, error: function(reject){

            }
    });

    });
</script>

<script type="text/javascript">
    $(document).on('click','#disable_btn', function(e){
            e.preventDefault();
            var user_id = document.getElementById("UpdateUserID").value;
            // alert(user_id);
            $.ajax({
            type: "post",
            url: "{{route('disable_user')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'id'     : user_id,
                'operation' : 2,
            },
            success: function(data){
                if(data.status == true){
                    // alert(data.msg)
                    $('#success_disable_msg').show();
                    document.getElementById("user_form").reset();
                    setTimeout(function() { $("#success_msg").hide(); }, 300);
                    window.setTimeout(function(){
                    window.location.href = "{{route('show_users')}}";
                    }, 5000);

                    // $('.user_row'+user_id).remove();
                }

                

            }, error: function(reject){

            }
    });

    });
</script>


<script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
            .attr('src', e.target.result)
                    //.width(450)
                    //.height(500);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


