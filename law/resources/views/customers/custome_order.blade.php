@extends('customers.master') 

@section('content')

@php
  $ServiceDetails = "";
  //var_dump($ServiceData);
  if(!empty($ServiceData)) {
    $ServiceID = $ServiceData->ServiceID;
    $ServiceDetails = $ServiceData->ServiceDetails;
    //var_dump($ServiceData);
  }//END if(!empty($ServiceData))
@endphp

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
    <center>
         <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="alert alert-danger " style="visibility:collapse;display: none;border-radius: 10px;" id="errorLabel" style=""> </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </center>
    <form method="POST"  id="Add_Form" enctype="multipart/form-data">  
        @csrf

    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-2 col-form-label" style="text-align: right;">وصف الخدمة</label>
                <div class="col-xl-10">
                  <textarea class="form-control " style="height: 100px; border-radius: 10px; margin-bottom: 10px;" name="OrderDescription" id="OrderDescription">{{$ServiceDetails}}</textarea>
                </div>
            </div>
        </div>
        <div class="col-xl-3"></div>
    </div>


    <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-2 col-form-label" style="text-align: right;">المجال</label>
                <div class="col-xl-10">
                    <select class="registration-input" name="FieldID" id="FieldID">
                        <option value="-1">اختر المجال </option>
                        @foreach($Fields as $Field)
                        <option value="{{$Field->FieldID}}">{{$Field->FieldName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-3"></div>
    </div>

    <div class="row" style="display: none;">
        <div class="col-xl-3"></div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-2 col-form-label" style="text-align: right;">المدينة</label>
                <div class="col-xl-10">
                    <select class="registration-input" name="CityID" id="CityID">
                        <option value="-1">اختر المدينة</option>
                        @foreach($Cities as $City)
                        <option value="{{$City->CityID}}">{{$City->CityName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xl-3"></div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-xl-4"> </div>
        <div class="col-xl-4">
            <center>
                <button id="Save" class="btn btn-primary button" style="width:150px;font-size: 22px; font-weight: 1000px;" onclick="return validation();"> طلب </button> 
            </center>
        </div>
        <div class="col-xl-4"> </div>
    </div>

     <br>
    <div class="row" id="success_add_msg" style="display: none;">
        <div class="form-group col-sm-3"></div>
        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert" style="border-radius: 10px;">
               <center> تم  طلب الخدمة بنجاح </center>
           </div>
       </div>
       <div class="form-group col-sm-3"></div>
    </div>

    <div class="row" id="faild_add_msg" style="display: none;">
        <div class="form-group col-sm-3"></div>
        <div class="form-group col-sm-6">
            <div class="alert alert-danger" role="alert" style="border-radius: 10px;">
               <center> لم يتم طلب الخدمة بنجاح  </center>
           </div>
       </div>
       <div class="form-group col-sm-3"></div>
    </div>
</form>
</div>
</div>

@endsection

<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    function validation() {    
        var OrderDescription = document.getElementById("OrderDescription").value;
        var CityID = document.getElementById("CityID").value;
        var FieldID = document.getElementById("FieldID").value;

        if(OrderDescription.length < 20 || OrderDescription.length > 250 ) {
            document.getElementById('errorLabel').innerHTML = "<?php echo " وصف الطلب يجب أن يتكون من 20 حرفاً على الأقل  ولا يزيد عن 250 حرفاً"; ?>";
            document.getElementById('errorLabel').style.visibility = 'visible';
            document.getElementById('errorLabel').style.display = 'block';
            document.forms["Add_Form"].elements["OrderDescription"].focus();
            return false;
        }//END if(OrderDescription.length < 50)
        
        else {
            document.getElementById('errorLabel').style.visibility = 'collapse';
            document.getElementById('errorLabel').style.display = 'none';
        }
            
        $(document).on('click','#Save', function(e){
                e.preventDefault();
                // alert("Monty");
                var form_data = new FormData($('#Add_Form')[0]);
                var url = "{{route('add_custom_order')}}";
                $.ajax({
                    type : "post",
                    url : url,
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data){
                        if(data.status == true){
                            // alert(data.msg)
                            $('#success_add_msg').show();
                            document.getElementById("Add_Form").reset();
                            setTimeout(function() { $("#success_msg").hide(); }, 2000);
                            window.setTimeout(function(){
                            window.location.href = "dashboard";
                            }, 3000);
                        }
                        else if(data.status == false) {
                            $('#faild_add_msg').show();    
                        }
                
                    }
            });
        });
    }//END function validation()

</script>
