<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

 @include('layout.admin.master')
<br>
<div class="container">
    <div class="cards">
<div class="ShowCard card ">
    <center><div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style="width: 50%; margin: 0 auto;"> </div></center>
    <form method="POST" name="ServiceForm"  id="ServiceForm" onsubmit="return validation();" enctype="multipart/form-data">  
        @csrf
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label  class="col-sm-4 col-form-label"> إسم الخدمة    </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="ServiceName" id="ServiceName" />
                    </div>

                    <div class="form-group col-sm-6">
                        <label  class="col-sm-6 col-form-label"> اختر النوع   </label>
                        <select class="form-control registration-input" name="ServiceType" id="ServiceType">
                            <option value="-1">اختر  النوع </option>
                            <option value="1">قانونية  </option>
                            <option value="2"> أخرى  </option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4" style="display: none;">
                        <label  class="col-sm-4 col-form-label"> السعر  </label>
                        <input type='text' class="form-control registration-input" placeholder=""  name="ServicePrice" id="ServicePrice" value="0" />
                    </div>
                 </div>
                 <br>
                <div class="row">
                    <div class="form-group col-sm-7">
                        <textarea class="form-control " rows="5" style="border-radius: 15px;"  placeholder=" تفاصيل الخدمة  " name="ServiceDetails" id="ServiceDetails"></textarea>
                    </div>
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="file" class="img-label" style=""> 
                        <img class="img-circle" id="blah" src="{{asset('assets/img/upload1.png')}}" onmouseover="bigImg(this)" onmouseout="normalImg(this)" alt="صورة المستند" / width="230px">      
                        <input class="file-upload registration-input" type="file" name="ServiceImage" accept="image/*" onchange="readURL(this);" id="file" style="display:none">          
                        </label>
                    </div>
                </div>

                <center>
                    <button id="save_data" class="btn btn-primary button" onclick="return validation()" style="font-size:17px;font-weight:bold; width:100px; margin-top: 20px;"> حفظ   </button>                 
                </center>

</form>
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


        @if($Services->Count() > 0)
            <div class="ShowCard card ">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped" style="width:90%" align="center">
                        <thead>
                            <tr>
                                <td align="center"><b>#</b></td>
                                <td align="center"><b> الإسم  </b></td>
                                <td align="center"><b>النوع  </b></td>
                                <td align="center"><b> عرض   </b></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $Counter = 0;
                            @endphp
                            @foreach($Services as $Service)
                                @php
                                    $Counter = $Counter+1;
                                    $ServiceTypeName = "";
                                    $ServiceType = $Service->ServiceType;
                                    if($ServiceType == 1) {
                                        $ServiceTypeName = "قانونية";
                                    }//END if($SubjectType == 1)
                                    else if($ServiceType == 2) {
                                        $ServiceTypeName = "أخرى";
                                    }//END if($SubjectType == 2)
                                @endphp
                                <tr>
                                    <td align="center">{{$Counter}}</td>
                                    <td align="center">{{$Service->ServiceName}}</td>
                                    <td align="center">{{$ServiceTypeName}}</td>
                                    <td align="center"><a href="{{route('service',$Service->ServiceID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> عرض </a></td>
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
            if(document.forms["ServiceForm"].elements["ServiceImage"].value=='') {
                document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء إختيار صورة الخدمة "; ?>";
                document.getElementById('errorLabel').style.visibility = 'visible'; 
                document.getElementById('errorLabel').style.display = 'block';  
                document.forms["ServiceForm"].elements["ServiceImage"].focus();
                return false;
            }
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
            url: "{{route('add_service')}}",
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
