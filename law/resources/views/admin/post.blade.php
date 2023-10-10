<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

 @include('layout.admin.master')
<br>
<div class="container">
    <center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style="width: 50%; margin: 0 auto;"> </div></center>
    <form method="POST" name="post_form"  id="post_form" onsubmit="return validation();" enctype="multipart/form-data">  
        @csrf
        <input type="hidden" name="SubjectID" id="SubjectID" value="{{$Post->SubjectID}}">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label  class="col-sm-4 col-form-label"> العنوان   </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="Title" id="Title" value="{{$Post->Title}}" />
                    </div>

                    @php
                        $SubjectType = $Post->SubjectType;
                        $FirstTypeSelected = "";
                        $SecondTypeSelected = "";
                        if($SubjectType == 1) {
                            $FirstTypeSelected = "selected";
                        }//END if($ServiceType == 1)
                        if($SubjectType == 2) {
                            $SecondTypeSelected = "selected";
                        }//END if($SubjectType == 2)
                    @endphp

                    <div class="form-group col-sm-4">
                        <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                        <select class="form-control registration-input" name="SubjectType" id="SubjectType" onchange="getSelectValue();">
                            <option value="-1">اختر  النوع </option>
                            <option value="1" <?php echo $FirstTypeSelected;?> >مقال </option>
                            <option value="2" <?php echo $SecondTypeSelected;?> >تشريع </option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label  class="col-sm-4 col-form-label"> الكاتب  </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="Author" id="Author" value="{{$Post->Author}}" />
                    </div>
                 </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label  class="col-sm-4 col-form-label"> المجال   </label>
                        <select class="form-control registration-input" name="FieldID" id="FieldID" >
                            <option value="-1">اختر المجال </option>
                            @foreach($Fields as $Field)
                            @php
                                $selected = "";
                                if($Post->FieldID == $Field->FieldID) {
                                    $selected = "selected";
                                }//END if($Post-FieldID == $Field->FieldID)
                            @endphp
                                <option value="{{$Field->FieldID}}" <?php echo $selected; ?> >{{$Field->FieldName}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="form-group col-sm-4">
                        <label  class="col-sm-4 col-form-label">تاريخ النشر  </label>
                        <input type='date' class="form-control registration-input" placeholder=""  name="FromDate" id="FromDate" value="{{$Post->FromDate}}" />          
                    </div>

                    <div class="form-group col-sm-4">
                        <label  class="col-sm-4 col-form-label"> تاريخ نهاية النشر  </label>
                        <input type='date' class="form-control registration-input" placeholder=""  name="ToDate" id="ToDate" value="{{$Post->ToDate}}" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4" id="DocumentsRow" style="display: none;">
                        <input type='file' class="form-control registration-input" placeholder=""  name="Documents[]" id="Documents[]" multiple />
                    </div>
                    <div class="col-sm-4"></div>
                </div>

                 <div class="row">
                    <div class="form-group col-sm-12">
                        <textarea class="form-control" style="border-radius: 15px;" rows="5"  placeholder="كتابة منشور " name="Content" id="Content">{{$Post->Content}}</textarea>
                    </div>
                </div>
               

                <center>
                    <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:70px; margin-top: 20px;"> تعديل   </button>
                     <button id="delete_btn" class="btn btn-danger button" style="font-size:17px;font-weight:bold; width:70px; margin-top: 20px;"> حذف </button>     
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
</body>
</html>

<script>

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click','#save_data', function(e){
        e.preventDefault();

        var form_data = new FormData($('#post_form')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('update_post')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_msg").show();
                    document.getElementById("post_form").reset();
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


</script>


 <script>
        function getSelectValue()
        {
            var SubjectType = document.getElementById("SubjectType").value;
           if(SubjectType == 1) {
                document.getElementById('DocumentsRow').style.display = 'none';
           }//END if(SubjectType == 1)
           else {
                document.getElementById('DocumentsRow').style.display = 'block';
           }//END else 
        }
        // getSelectValue();
    </script>

        <script>
        function validation() {

            var Content = document.getElementById("Content").value;
            // alert(Content); 
            if(document.forms["post_form"].elements["Content"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال العنوان"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["Content"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["Title"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال العنوان"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["Title"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["SubjectType"].value=='-1') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء اختيار النوع"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["SubjectType"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["Author"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo " الرجاء كتابة إسم الناشر "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["Author"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["FieldID"].value=='-1') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء اختيار المجال"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["FieldID"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["FromDate"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo " الرجاء تحديد تاريخ النشر "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["FromDate"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
            if(document.forms["post_form"].elements["ToDate"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo " الرجاء تحديد تاريخ نهاية النشر "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["post_form"].elements["ToDate"].focus();
                // document.getElementById("wrong_msg").style.visibility = 'collapse';
                return false;
            }
        }//END function validation()
    </script>

<script type="text/javascript">
    $(document).on('click','#delete_btn', function(e){
            e.preventDefault();
            var SubjectID = document.getElementById("SubjectID").value;
            // alert(ServiceID);
                   $.ajax({
            type: "post",
            url: "{{route('delete_post')}}",
            data: {
                'SubjectID'     : SubjectID,
                'operation' : 1
            },
            success: function(data){
                if(data.status == true){
                    // alert(data.msg)
                    $('#success_msg').show();
                    document.getElementById("post_form").reset();
                    setTimeout(function() { $("#success_msg").hide(); }, 2000);
                    window.setTimeout(function(){
                    window.location.href = "{{route('posts')}}";
                    // location.reload();
                    }, 3000);

                    // $('.user_row'+SubjectID).remove();
                }
            }, error: function(reject){

            }
    });
     

    });
</script>