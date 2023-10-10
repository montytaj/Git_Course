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
            <div class="row">
                <div class="form-group col-sm-4">
                    <label  class="col-sm-4 col-form-label"> العنوان   </label>
                    <input type='text' class="form-control registration-input" placeholder=""  name="Title" id="Title" />
                </div>

                <div class="form-group col-sm-4">
                    <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                    <select class="form-control registration-input" name="SubjectType" id="SubjectType" onchange="getSelectValue();">
                        <option value="-1">اختر  النوع </option>
                        <option value="1">مقال </option>
                        <option value="2">تشريع </option>
                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label  class="col-sm-4 col-form-label"> الكاتب  </label>
                    <input type='text' class="form-control registration-input" placeholder=""  name="Author" id="Author" />
                </div>
             </div>

            <div class="row">
                <div class="form-group col-sm-4">
                    <label  class="col-sm-4 col-form-label"> المجال   </label>
                    <select class="form-control registration-input" name="FieldID" id="FieldID" >
                        <option value="-1">اختر المجال </option>
                        @foreach($Fields as $Field)
                            <option value="{{$Field->FieldID}}">{{$Field->FieldName}}</option>
                        @endforeach
                    </select>
                </div>
               
                <div class="form-group col-sm-4">
                    <label  class="col-sm-4 col-form-label">تاريخ النشر  </label>
                    <input type='date' class="form-control registration-input" placeholder=""  name="FromDate" id="FromDate" />          </div>

                <div class="form-group col-sm-4">
                    <label  class="col-sm-4 col-form-label"> تاريخ نهاية النشر  </label>
                    <input type='date' class="form-control registration-input" placeholder=""  name="ToDate" id="ToDate" />
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
            <br>
            <div class="row">
                <div class="form-group col-sm-12">
                    <textarea class="form-control" rows="5" style="border-radius: 15px;"  placeholder="كتابة منشور " name="Content" id="Content"></textarea>
                </div>
            </div>

                <center>
                    <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:70px; margin-top: 20px;"> حفظ   </button>                 
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

        @if($Libraries->Count() > 0)
            <div class="ShowCard card ">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:90%" align="center">
                        <thead>
                            <tr>
                                <td align="center"><b>#</b></td>
                                <td align="center"><b>العنوان  </b></td>
                                <td align="center"><b>النوع  </b></td>
                                <td align="center"><b> الكاتب  </b></td>
                                <td align="center"><b> تاريخ بداية النشر  </b></td>
                                <td align="center"><b> تاريخ نهاية النشر </b></td>
                                <td align="center"><b> عرض   </b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $Counter = 0;
                            @endphp
                            @foreach($Libraries as $Library)
                                @php
                                    $Counter = $Counter+1;
                                    $SubjectTypeName = "";
                                    $SubjectType = $Library->SubjectType;
                                    if($SubjectType == 1) {
                                        $SubjectTypeName = "مقال";
                                    }//END if($SubjectType == 1)
                                    else if($SubjectType == 2) {
                                        $SubjectTypeName = "تشريع";
                                    }//END if($SubjectType == 2)
                                @endphp
                                <tr>
                                    <td align="center">{{$Counter}}</td>
                                    <td align="center">{{$Library->Title}}</td>
                                    <td align="center">{{$SubjectTypeName}}</td>
                                    <td align="center">{{$Library->Author}}</td>
                                    <td align="center">{{$Library->FromDate}}</td>
                                    <td align="center">{{$Library->ToDate}}</td>
                                    <td align="center"><a href="{{route('post',$Library->SubjectID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> عرض </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        @endif

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
            url: "{{route('add_post')}}",
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