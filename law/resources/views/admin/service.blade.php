<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

 @include('layout.admin.master')
<br>
<div class="container">
    <div class="ShowCard card ">
    <div class="cards">
    <center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style="width: 50%; margin: 0 auto;"> </div></center>
    <form method="POST" name="ServiceForm"  id="ServiceForm" onsubmit="return validation();" enctype="multipart/form-data">  
        @csrf
                <input type="hidden" name="ServiceID" id="ServiceID" value="<?php echo $Service->ServiceID; ?>">
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 col-form-label"> إسم الخدمة    </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="ServiceName" id="ServiceName" value="{{$Service->ServiceName}}" />
                    </div>
                    @php
                        $ServiceType = $Service->ServiceType;
                        $FirstTypeSelected = "";
                        $SecondTypeSelected = "";
                        if($ServiceType == 1) {
                            $FirstTypeSelected = "selected";
                        }//END if($ServiceType == 1)
                        if($ServiceType == 2) {
                            $SecondTypeSelected = "selected";
                        }//END if($ServiceType == 2)
                    @endphp
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                        <select class="form-control registration-input" name="ServiceType" id="ServiceType">
                            <option value="-1">اختر  النوع </option>
                            <option value="1" <?php echo $FirstTypeSelected;?> >قانونية  </option>
                            <option value="2" <?php echo $SecondTypeSelected;?> > أخرى  </option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4" style="display: none;">
                        <label  class="col-sm-4 col-form-label"> السعر  </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="ServicePrice" id="ServicePrice" value="{{$Service->ServicePrice}}" />
                    </div>
                 </div>
                 <br>
                 <div class="row">
                    <div class="form-group col-sm-7">
                        <textarea class="form-control " rows="5" style="border-radius: 15px;"  placeholder=" تفاصيل الخدمة  " name="ServiceDetails" id="ServiceDetails">{{$Service->ServiceDetails}}</textarea>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    @php
                        if(!empty($Service->ServiceImage)) {
                            $ServiceImagePath = $Service->ServiceImage;
                        }//END if(!empty($Service->ServiceImage))
                        else
                        {
                            $ServiceImagePath = 'assets/img/upload1.png';
                        }
                    @endphp
                        <div class="form-group col-sm-4">
                            <label for="file" class="img-label" style=""> 
                           <img class="img-circle" id="blah" src="{{asset($ServiceImagePath)}}" onmouseover="bigImg(this)" onmouseout="normalImg(this)" alt="صورة المستند" / width="230px">      
                           <input class="file-upload registration-input" type="file" name="ServiceImage" accept="image/*" onchange="readURL(this);" id="file" style="display:none">          
                       </label>
                    </div>
                </div>

                <center>
                    <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:100px; margin-top: 20px;"> تعديل   </button>
                     <button id="delete_btn" class="btn btn-danger button" style="font-size:17px;font-weight:bold; width:100px; margin-top: 20px;"> حذف </button>     
                </center>

</form>

<br>
<div class="row" id="success_msg" style="display: none;">
    <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
    <div class="form-group col-sm-6">
        <div class="alert alert-success" role="alert">
           <center> <b>تمت العملية بنجاح </b>   </center>
       </div>
   </div>
    <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>
</div>
</div>
</body>
</html>



        <script>
        function validation() {
            // alert("Montasir");
                        if(document.forms["ServiceForm"].elements["ServiceName"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال  إسم الخدمة "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["ServiceForm"].elements["ServiceName"].focus();
                return false;
            }
            if(document.forms["ServiceForm"].elements["ServiceType"].value=='-1') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  إختيار نوع الخدمة "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["ServiceForm"].elements["ServiceType"].focus();
                return false;
            }
            // if(document.forms["ServiceForm"].elements["ServicePrice"].value=='') {
            //     document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  تحديد سعر الخدمة"; ?>";
            //     document.getElementById('errorLabel').style.visibility = 'visible'; 
            //     document.getElementById('errorLabel').style.display = 'block';  
            //     document.forms["ServiceForm"].elements["ServicePrice"].focus();
            //     return false;
            // }
            if(document.forms["ServiceForm"].elements["ServiceDetails"].value.length < 20) {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال  تفاصيل الخدمة   20 حرفا على الأقل"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["ServiceForm"].elements["ServiceDetails"].focus();
                return false;
            }
            if(document.forms["ServiceForm"].elements["ServiceDetails"].value.length > 250) {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال  تفاصيل الخدمة   250 حرفا على  الأكثر"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["ServiceForm"].elements["ServiceDetails"].focus();
                return false;
            }
            // if(document.forms["ServiceForm"].elements["ServiceImage"].value=='') {
            //     document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء إختيار صورة الخدمة "; ?>";
            //     document.getElementById('errorLabel').style.visibility = 'visible'; 
            //     document.getElementById('errorLabel').style.display = 'block';  
            //     document.forms["ServiceForm"].elements["ServiceImage"].focus();
            //     return false;
            // }
            else {
                document.getElementById('errorLabel').style.visibility = 'collapse'; 
                document.getElementById('errorLabel').style.display = 'none';
            }

            
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click','#save_data', function(e){
        e.preventDefault();

        var form_data = new FormData($('#ServiceForm')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('update_service')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_msg").show();
                    document.getElementById("ServiceForm").reset();
                    setTimeout(function() { $("#success_msg").hide();
                    location.reload();
                        }, 3000);
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
        }//END function validation()
    </script>


<script type="text/javascript">
    $(document).on('click','#delete_btn', function(e){
            e.preventDefault();
            // var ServiceID = document.getElementById("ServiceID").value;
            // alert(ServiceID);
            var form_data = new FormData($('#ServiceForm')[0]);   
            $.ajax({
                type: "post",
                url: "{{route('delete_service')}}",
                data: form_data,
                processData : false,
                contentType : false,
                cache :false,
                
                success: function(data){
                    if(data.status == true){
                        // alert(data.msg)
                        $('#success_msg').show();
                        document.getElementById("ServiceForm").reset();
                        setTimeout(function() { $("#success_msg").hide(); }, 2000);
                        window.setTimeout(function(){
                        window.location.href = "{{route('admin_services')}}";
                        // location.reload();
                        }, 3000);

                        // $('.user_row'+ServiceID).remove();
                    }
                }, error: function(reject){

                }
    });
     

    });
</script>