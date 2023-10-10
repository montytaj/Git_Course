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
        <div class="row">
            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> إسم  الدورة    </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseName" id="CourseName" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> مقدم الدورة   </label>
            <input type='text' class="form-control registration-input" placeholder=""  name="CoursePresenter" id="CoursePresenter" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                <select class="form-control registration-input" name="CourseType" id="CourseType">
                    <option value="-1">اختر  النوع </option>
                    <option value="1">حضوري   </option>
                    <option value="2"> أونلاين  </option>
                </select>
            </div>
         </div>

         <div class="row">
            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> تاريخ  الدورة    </label>
                <input type='date' class="form-control registration-input" placeholder=""  name="CourseDate" id="CourseDate" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> ساعات  الدورة   </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseHours" id="CourseHours" />
            </div>

            <div class="form-group col-sm-4">
                <label  class="col-sm-4 col-form-label"> رابط الدورة   </label>
                <input type='text' class="form-control registration-input" placeholder=""  name="CourseLink" id="CourseLink" />
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
            <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:100px; margin-top: 20px;"> حفظ   </button>                 
        </center>

</form>
</div>
</div>

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

        @if($Courses->Count() > 0)
            <div class="ShowCard card ">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:90%" align="center">
                        <thead>
                            <tr>
                                <td align="center"><b>#</b></td>
                                <td align="center"><b> الإسم  </b></td>
                                <td align="center"><b>النوع  </b></td>
                                <td align="center"><b> مقدم الدورة  </b></td>
                                <td align="center"><b> تاريخ الدورة  </b></td>
                                <td align="center"><b> ساعات الدورة  </b></td>
                                <td align="center"><b> الرابط  </b></td>
                                <td align="center"><b> عرض   </b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $Counter = 0;
                            @endphp
                            @foreach($Courses as $Course)
                                @php
                                    $Counter = $Counter+1;
                                    $CourseTypeName = "";
                                    $CourseType = $Course->CourseType;
                                    if($CourseType == 1) {
                                        $CourseTypeName = "حضوري";
                                    }//END if($SubjectType == 1)
                                    else if($CourseType == 2) {
                                        $CourseTypeName = "أونلاين";
                                    }//END if($SubjectType == 2)
                                @endphp
                                <tr>
                                    <td align="center">{{$Counter}}</td>
                                    <td align="center">{{$Course->CourseName}}</td>
                                    <td align="center">{{$CourseTypeName}}</td>
                                    <td align="center">{{$Course->CoursePresenter}}</td>
                                    <td align="center">{{$Course->CourseDate}}</td>
                                    <td align="center">{{$Course->CourseHours}}</td>
                                    <td align="center"><a href="https://{{$Course->CourseLink}}" target="_blank">{{$Course->CourseLink}}</a></td>
                                    <td align="center"><a href="{{route('course',$Course->CourseID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> عرض </a></td>
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

        var form_data = new FormData($('#CourseForm')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('add_course')}}",
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


    <script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah2')
            .attr('src', e.target.result)
                    //.width(450)
                    //.height(500);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah3')
            .attr('src', e.target.result)
                    //.width(450)
                    //.height(500);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
