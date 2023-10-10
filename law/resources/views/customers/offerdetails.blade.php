@extends('customers.payment_master') 

@section('content')

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
    <center>
        <div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style=""> </div>
    </center>
    @php 
        if(isset($CustomOrderOffers)) {  
        $CustomerData = session()->get('CustomerData');
        $BuyerName = $CustomerData['FirstName']." ".$CustomerData['LastName'] ;
        $BuyerEmail = $CustomerData['Email'];
        $BuyerPhone = $CustomerData['PhoneNumber'];

    @endphp
        <form method="POST"  id="Add_Form" enctype="multipart/form-data">  
            @csrf
                <input type="hidden" name="ServiceID" id="ServiceID" value="{{$CustomOrderOffers->OfferID}}">
                <input type="hidden" name="BuyerName" id="BuyerName" value="{{$BuyerName}}">
                <input type="hidden" name="BuyerEmail" id="BuyerEmail" value="{{$BuyerEmail}}">
                <input type="hidden" name="BuyerPhone" id="BuyerPhone" value="{{$BuyerPhone}}">
                <input type="hidden" name="ServiceType" id="ServiceType" value="2">

                
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">وصف الخدمة</label>
                            <div class="col-xl-10">
                              <textarea class="form-control " style="height: 100px; border-radius: 10px; margin-bottom: 10px;" name="OrderDescription" id="OrderDescription" disabled>{{$CustomOrderOffers->Description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">مقدم العرض </label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->lawyers->FirstName}} {{$CustomOrderOffers->lawyers->LastName}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;"> تاريخ / زمن العرض </label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->OfferDate}} {{$CustomOrderOffers->OfferTime}}" disabled>
                            </div>
                        </div>                        
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">السعر  </label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->Price}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;"> نسبة الضريبة   </label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->Tax}} %" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;"> إجمالي المبلغ    </label>
                            <div class="col-xl-10">
                                <input class="registration-input"  value="{{$CustomOrderOffers->TotalAmount}}" id="CurrentPrice" name="CurrentPrice" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">المجال</label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->lawyers->fields->FieldName}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">المدينة</label>
                            <div class="col-xl-10">
                                <input class="registration-input" value="{{$CustomOrderOffers->lawyers->city->CityName}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">طريقة الدفع</label>
                            <div class="col-xl-10">
                                <select class="registration-input" id="PaymentType" name="PaymentType">
                                    <option value="-1">اختر طريقة الدفع</option>
                                    <option value="1">Mada</option>
                                    <option value="2">Visa</option>
                                    <option value="3">MasterCard</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-4"> </div>
                    <div class="col-xl-4">
                        @if($CustomOrderOffers->Status == 1 or $CustomOrderOffers->Status == 2) 
                            <center>
                                <button id="BuyService" class="btn btn-success button" style="width:100px;" onclick="return Validation();"> موافقة  </button>
                            </center>
                             </div>
                    <div class="col-xl-4"> </div>
                </div>

                <div class="row" id="loader" style="display: none;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <center>
            <img class="rounded-circle" src="{{asset('public/assets/img/loading.gif')}}" width="50px" height="50px" style="margin-bottom: 15px; margin-top: 10px;">
            </center>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
    <div id="ShowPayForm"></div>
    
    
    @if(isset($ShowSuccessPaymentMessage))
        <div class="col-sm-12" id="ShowSuccessPaymentMessage">
                  <center>
            <script>
                        swal({
                              title: '<img  src="{{asset('public/assets/img/blc.jpg')}}" style="margin-bottom: 15px; margin-top: 10px;" width="100px" height="100px"> <br> <b> {{$ShowSuccessPaymentMessage}}</b>',
                              type: '',
                              html:
                                '<b>All </b>',
                            });
                        window.setTimeout(function(){
                        window.location.href = "{{route('index')}}";
                            }, 5000);

                </script>
              </center>
    </div>
    @endif

        @if(isset($ShowFailPaymentMessage))
            <div class="col-sm-12" id="ShowFailPaymentMessage">
              <center>       
                <script>
                        swal({
                              title: '<img  src="{{asset('public/assets/img/blc.jpg')}}" style="margin-bottom: 15px; margin-top: 10px;" width="100px" height="100px"> <br> <b> {{$ShowFailPaymentMessage}}</b>',
                              type: '',
                              html:
                                '<b>All </b>',
                            });
                        window.setTimeout(function(){
                        window.location.href = "{{route('index')}}";
                            }, 5000);
                        </script>
                  </center>
        </div>
        @endif
        <script>
          setTimeout(function () {
                $("#ShowSuccessPaymentMessage").hide();
            }, 10000);
        </script>
    
        <script>
          setTimeout(function () {
                $("#ShowFailPaymentMessage").hide();
            }, 10000);
        </script>
                        @else

                    <div class="row">
                        <div class="form-group col-sm-2"></div>
                            <div class="form-group col-sm-8">
                                <div class="alert alert-danger" role="alert">
                                   <center> لا يمكنك الحذف أو التعديل   </center>
                                </div>
                       </div>
                       <div class="form-group col-sm-2"></div>
                    </div>

                        @endif
                   

                 <br>
                <div class="row" id="success_update_msg" style="display: none;">
                    <div class="form-group col-sm-3"></div>
                    <div class="form-group col-sm-6">
                        <div class="alert alert-success" role="alert">
                           <center> تم   تعديل  الطلب بنجاح </center>
                       </div>
                   </div>
                   <div class="form-group col-sm-3"></div>
                </div>

                <div class="row" id="faild_update_msg" style="display: none;">
                    <div class="form-group col-sm-3"></div>
                    <div class="form-group col-sm-6">
                        <div class="alert alert-danger" role="alert">
                           <center> لم يتم  تعديل  الطلب بنجاح  </center>
                       </div>
                   </div>
                   <div class="form-group col-sm-3"></div>
                </div>

                <div class="row" id="success_delete_msg" style="display: none;">
                    <div class="form-group col-sm-3"></div>
                    <div class="form-group col-sm-6">
                        <div class="alert alert-success" role="alert">
                           <center> تم   حذف   الطلب بنجاح </center>
                       </div>
                   </div>
                   <div class="form-group col-sm-3"></div>
                </div>

                <div class="row" id="faild_delete_msg" style="display: none;">
                    <div class="form-group col-sm-3"></div>
                    <div class="form-group col-sm-6">
                        <div class="alert alert-danger" role="alert">
                           <center> لم يتم  حذف   الطلب بنجاح  </center>
                       </div>
                   </div>
                   <div class="form-group col-sm-3"></div>
                </div>




    </form>
    @php

 }//END if(isset($CustomOrder))
 else {
@endphp

    <div class="row">
        <div class="form-group col-sm-12">
            <div class="alert alert-danger" role="alert">
               <center> لا توجد بيانات  </center>
           </div>
       </div>
    </div>

@php 
    }//END else
@endphp

</div>
</div>

@endsection

<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">

    function Validation() {
        if(document.forms["Add_Form"].elements["PaymentType"].value=='-1') {
            document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء اختيار طريقة الدفع"; ?>";
            document.getElementById('errorLabel').style.visibility = 'visible'; 
            document.getElementById('errorLabel').style.display = 'block';  
            document.forms["Add_Form"].elements["PaymentType"].focus();
            return false;
        }
    $(document).on('click', '#BuyService', function(e) {
        // alert("Monty");
        e.preventDefault();
        var form_data = new FormData($('#Add_Form')[0]);

        $.ajax({
            type: "post",
            enctype: "multipart/form-data",
            url: "{{route('buyservice')}}",
            data: form_data,
            beforeSend: function(){
                // Show image container
                $("#loader").show();
            },
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == true) {
                    // alert(data.msg)                    
                    $("#ShowPayForm").empty().html(data.content);
                }//END if (data.status == true)
                else {
                    $("#DangerMessage").show();
                    setTimeout(function() {
                        $("#DangerMessage").hide();
                    }, 5000);

                }//END else

            },
           complete:function(data){
            // Hide image container
            $("#loader").hide();
           },
            error: function(reject) {

                var response = $.parseJSON(reject.responseText);

                $.each(response.errors, function(key, val) {

                    $("#" + key + "_error").text(val[0]);
                });

            }
        });
    });
        
}//END function ServiceValidation()


</script>
