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
    <form method="POST" name="CourseForm"  id="CourseForm" onsubmit="return validation();" enctype="multipart/form-data">  
        @csrf
        <input type="hidden" name="CourseID" id="CourseID" value="{{$Course->CourseID}}">
        <div class="row">
            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> إسم  الدورة    </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseName" id="CourseName" value="{{$Course->CourseName}}" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> مقدم الدورة   </label>
            <input type='text' class="form-control registration-input" placeholder=""  name="CoursePresenter" id="CoursePresenter" value="{{$Course->CoursePresenter}}" />
            </div>
            @php
                $CourseType = $Course->CourseType;
                $FirstTypeSelected = "";
                $SecondTypeSelected = "";
                if($CourseType == 1) {
                    $FirstTypeSelected = "selected";
                }//END if($CourseType == 1)
                if($CourseType == 2) {
                    $SecondTypeSelected = "selected";
                }//END if($CourseType == 2)
            @endphp
            <div class="form-group col-sm-4">
                <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                <select class="form-control registration-input" name="CourseType" id="CourseType">
                    <option value="-1">اختر  النوع </option>
                    <option value="1" <?php echo $FirstTypeSelected;?> >حضوري   </option>
                    <option value="2" <?php echo $SecondTypeSelected;?> > أونلاين  </option>
                </select>
            </div>
         </div>

         <div class="row">
            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> تاريخ  الدورة    </label>
                <input type='date' class="form-control registration-input" placeholder=""  name="CourseDate" id="CourseDate" value="{{$Course->CourseDate}}" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> ساعات  الدورة   </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseHours" id="CourseHours" value="{{$Course->CourseHours}}" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> رابط الدورة   </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseLink" id="CourseLink" value="{{$Course->CourseLink}}" />
            </div>
         </div>

        <div class="row">
            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> صورة الدورة   </label>
                <input type="file" class="registration-input" name="CourseImage" id="CourseImage" placeholder="">
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> صورة مقدم الدورة   </label>
                <input type="file" class="registration-input" name="CoursePresenterImage" id="CoursePresenterImage" placeholder="">
            </div>

            <div class="form-group col-sm-4">
                <div class="Icon-inside">
                    <label  class="col-sm-4 col-form-label"> صورة شعار الدورة   </label>
                    <input type="file" class="registration-input" name="CourseLogo" id="CourseLogo" placeholder="">
                </div>
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

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click','#save_data', function(e){
        e.preventDefault();

        var form_data = new FormData($('#CourseForm')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('update_course')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_msg").show();
                    document.getElementById("CourseForm").reset();
                    setTimeout(function() { $("#success_msg").hide();
                    location.reload();
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
</script>


        <script>
        function validation() {
            // alert("Montasir");
            if(document.forms["CourseForm"].elements["CourseName"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال   إسم الدورة "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CourseName"].focus();
                return false;
            }
            if(document.forms["CourseForm"].elements["CoursePresenter"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء ادخال   مقدم الدورة"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CoursePresenter"].focus();
                return false;
            }
            if(document.forms["CourseForm"].elements["CourseType"].value=='-1') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  إختيار نوع  الدورة "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CourseType"].focus();
                return false;
            }
            if(document.forms["CourseForm"].elements["CourseDate"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  تحديد  تاريخ الدورة"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CourseDate"].focus();
                return false;
            }
            if(document.forms["CourseForm"].elements["CourseHours"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  تحديد  ساعات الدورة"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CourseHours"].focus();
                return false;
            }
            if(document.forms["CourseForm"].elements["CourseLink"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء  تحديد  رابط  الدورة"; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["CourseForm"].elements["CourseLink"].focus();
                return false;
            }
        }//END function validation()
    </script>


<script type="text/javascript">
    $(document).on('click','#delete_btn', function(e){
           // alert("Montasir");
            e.preventDefault();
            var CourseID = document.getElementById("CourseID").value;
            // alert(CourseID);
            $.ajax({
                type: "post",
                url: "{{route('delete_course')}}",
                data: {
                    'CourseID'     : CourseID,
                    'operation' : 1
                },
                success: function(data){
                    if(data.status == true){
                        $('#success_msg').show();
                        setTimeout(function() { $("#success_msg").hide(); }, 2000);
                        window.setTimeout(function(){
                        window.location.href = "{{route('courses')}}";
                          }, 3000);
                        }
                    }, error: function(reject){
                }
            });
    });
</script>