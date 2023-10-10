@extends('customers.payment_master') 

@section('content')

    @php 
        if(isset($CustomOrderOffers)) {  
            $CustomerData = session()->get('CustomerData');
            $BuyerName = $CustomerData['FirstName']." ".$CustomerData['LastName'] ;
            $BuyerEmail = $CustomerData['Email'];
            $BuyerPhone = $CustomerData['PhoneNumber'];
          }
    @endphp

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
    @php if(isset($CustomOrder)) {  @endphp
        <form method="POST"  id="Add_Form" enctype="multipart/form-data" style="display: none;">  
            @csrf
                <input type="hidden" name="UpdateID" id="UpdateID" value="{{$CustomOrder->CustomOrderID}}">
                <div class="row">
                    <div class="col-xl-3"></div>
                    <div class="col-xl-6">
                        <div class="form-group row">
                            <label class="col-xl-2 col-form-label" style="text-align: right;">وصف الخدمة</label>
                            <div class="col-xl-10">
                              <textarea class="form-control " style="height: 100px; border-radius: 10px; margin-bottom: 10px;" name="OrderDescription" id="OrderDescription">{{$CustomOrder->Description}}</textarea>
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
                                        @php
                                            $Selected = "";
                                            if($CustomOrder->FieldID == $Field->FieldID) {
                                                $Selected = "selected";
                                            }//END if($CustomOrder->FieldID == $Field->FieldID)
                                        @endphp
                                        <option value="{{$Field->FieldID}}" {{$Selected}}>{{$Field->FieldName}}</option>
                                        @php $Selected = ""; @endphp
                                    @endforeach
                                </select>
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
                                <select class="registration-input" name="CityID" id="CityID">
                                    <option value="-1">اختر المدينة</option>
                                    @foreach($Cities as $City)
                                        @php
                                            $Selected = "";
                                            if($CustomOrder->CityID == $City->CityID) {
                                                $Selected = "selected";
                                            }//END if($CustomOrder->CityID == $City->CityID)
                                        @endphp
                                        <option value="{{$City->CityID}}" {{$Selected}}>{{$City->CityName}}</option>
                                        @php $Selected = ""; @endphp
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3"></div>
                </div>

                <div class="row">
                    <div class="col-xl-4"> </div>
                    <div class="col-xl-4">
                        @if($CustomOrder->Status == 1) 
                            <center>
                                <button id="Update" class="btn btn-success button" style="width:100px;" onclick="return validation();"> تعديل </button>
                                <button id="Delete" class="btn btn-danger button" style="width:100px;" onclick="return validation();"> حذف  </button> 
                            </center>
                             </div>
                    <div class="col-xl-4"> </div>
                </div>
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

@if($CustomOrderOffers->Count() > 0)
<br>


      <div class="modal MyModal" role="dialog" id="PaymentModel" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <div class="">
                <div class="modal-title" style="text-align: center;">
                  <h3>
                    <center> سداد قيمة الخدمة   </center>
                  </h3>
                </div>
              </div>
            </div>
            <div class="modal-body">
                
            </div>
          </div>
        </div>
      </div>


    <div class="card2 ShowCard2">
         <center>
            <div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style=""> </div>
            <div class="row" id="loader" style="display: none;">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <center>
                    <img class="rounded-circle" src="{{asset('public/assets/img/loading.gif')}}" width="200px" height="200px" style="margin-bottom: 15px; margin-top: 10px;">
                    </center>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div id="ShowPayForm"></div>
         </center>
   
                <div class="row">
                @foreach($CustomOrderOffers as $Offer)

                <div class="col-xl-6" style="margin-bottom: 25px;"> 
                    <div class="card bg-primary" style="text-align: center; border-radius: 7px;">
                        <div class="card-header" style="display: none;">
                            <button id="Update" class="btn btn-secondary button" style="width:70%; margin:0 auto;margin-top: -18px; border-radius: 7px; background-color: white; color: black;"> أقل عرض سعر  </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;">وصف الخدمة </div>
                                <div class="col-xl-1"></div>
                                <div class="col-xl-8 card custome_card" style="min-height: 100px; max-height: 100px;"> {{$Offer->Description}} </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;">مدة الإنجاز  </div>
                                <div class="col-xl-1"></div>
                                <div class="col-xl-8 card custome_card"> {{$Offer->Execution_Period}}  ساعة  </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;"> السعر  </div>
                                <div class="col-xl-1"></div>
                                <div class="col-xl-8 card custome_card"> {{$Offer->TotalAmount}}  ريال   </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;"> المحامي   </div>
                                <div class="col-xl-1"></div>
                                <div class="col-xl-8 card custome_card"> {{$Offer->lawyers['FirstName']}} {{$Offer->lawyers['LastName']}} </div>
                            </div>
                        </div>
                        <div class="card-footer" style="display: nones;">
                          <form method="POST"  id="Form{{$Offer->OfferID}}" enctype="multipart/form-data">  
                                 @csrf
                                    <input type="hidden" name="ServiceID{{$Offer->OfferID}}" id="ServiceID{{$Offer->OfferID}}" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="BuyerName{{$Offer->OfferID}}" id="BuyerName{{$Offer->OfferID}}" value="{{$BuyerName}}">
                                    <input type="hidden" name="BuyerEmail{{$Offer->OfferID}}" id="BuyerEmail{{$Offer->OfferID}}" value="{{$BuyerEmail}}">
                                    <input type="hidden" name="BuyerPhone{{$Offer->OfferID}}" id="BuyerPhone{{$Offer->OfferID}}" value="{{$BuyerPhone}}">
                                    <input type="hidden" name="ServiceType{{$Offer->OfferID}}" id="ServiceType{{$Offer->OfferID}}" value="2">
                                    <input type="hidden" name="OfferID" id="OfferID" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="TotalAmount{{$Offer->OfferID}}" id="TotalAmount{{$Offer->OfferID}}" value="{{$Offer->TotalAmount}}">
                                      <div class="row">
                                          <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;"> المحامي   </div>

                                        <div class="col-xl-1"></div>
                                        <div class="col-xl-8 custome_card ">
                                                  <select class="registration-input" style="border-radius: 3px;" id="PaymentType{{$Offer->OfferID}}" name="PaymentType{{$Offer->OfferID}}">
                                                      <option value="-1">اختر طريقة الدفع</option>
                                                      <option value="1">Mada</option>
                                                      <option value="2">Visa</option>
                                                      <option value="3">MasterCard</option>
                                                  </select>
                                          </div>
                                    </div>  

                              </form>
                        </div>
                    </div>
                </div>


                    <div class="col-md-4 " style="display: none;">
                        <div class="card service_card">
                          <div class="card-header" style="width: 100%; margin:0 auto">
                            @php
                                $Img = 'assets/img/2.jpg';
                            @endphp
                            <img style="display: none;" src="{{asset(asset($Img))}}" width="100%" height="120px" class="card-img-top img-circle" alt="...">
                                <div class="discription" style="margin: 10px;">
                                    {{$Offer->Description}}
                                </div>
                            <br>
                            <center>المحامي : {{$Offer->lawyers['FirstName']}} {{$Offer->lawyers['LastName']}}</center>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col align-self-start">
                                <div class="" style="text-align: ;"> مدة الإنجاز  <br> {{$Offer->Execution_Period}} </div>
                              </div>
                              <div class="col align-self-center">

                              </div>
                              <div class="col align-self-end">
                                <div class="Icon-inside" style="margin-left: 15px; text-align: left;">
                                  <div class="product_price" style="text-align:;"> السعر <br>
                                    <div class="number" style="margin: 0 auto; text-align: center;"> {{$Offer->TotalAmount}} SR </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                             <form method="POST"  id="Form{{$Offer->OfferID}}" enctype="multipart/form-data">  
                                 @csrf
                                    <input type="hidden" name="ServiceID{{$Offer->OfferID}}" id="ServiceID{{$Offer->OfferID}}" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="BuyerName{{$Offer->OfferID}}" id="BuyerName{{$Offer->OfferID}}" value="{{$BuyerName}}">
                                    <input type="hidden" name="BuyerEmail{{$Offer->OfferID}}" id="BuyerEmail{{$Offer->OfferID}}" value="{{$BuyerEmail}}">
                                    <input type="hidden" name="BuyerPhone{{$Offer->OfferID}}" id="BuyerPhone{{$Offer->OfferID}}" value="{{$BuyerPhone}}">
                                    <input type="hidden" name="ServiceType{{$Offer->OfferID}}" id="ServiceType{{$Offer->OfferID}}" value="2">
                                    <input type="hidden" name="OfferID" id="OfferID" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="TotalAmount{{$Offer->OfferID}}" id="TotalAmount{{$Offer->OfferID}}" value="{{$Offer->TotalAmount}}">
                                    <div class="form-group row">
                                        <label class="col-xl-4 col-form-label" style="text-align: right;">طريقة الدفع</label>
                                        <div class="col-xl-8">
                                                  <select class="registration-input" id="PaymentType{{$Offer->OfferID}}" name="PaymentType{{$Offer->OfferID}}">
                                                      <option value="-1">اختر طريقة الدفع</option>
                                                      <option value="1">Mada</option>
                                                      <option value="2">Visa</option>
                                                      <option value="3">MasterCard</option>
                                                  </select>
                                          </div>
                                    </div>  

                              </form>
                          <div class="card-footer">
                              <div style="display: none;" class="p-4"><button class="btn button btn-primary" type="text" id="RegistrationCustomer" onclick="Accept({{$Offer->OfferID}});"> قبول  </button></div>
                              
                              <button id="BuyService{{$Offer->OfferID}}" class="btn btn-success button" style="width:100%;" onclick="return Validation({{$Offer->OfferID}});"> قبول العرض  </button>
                          </div>

                        </div>
                      </div>
                @endforeach
          </div>
    </div>
          @else

            <div class="row">
                  <div class="form-group col-sm-3"></div>
                  <div class="form-group col-sm-6">
                      <div class="alert alert-danger" role="alert">
                         <center> لا توجد عروض  </center>
                     </div>
                 </div>
                 <div class="form-group col-sm-3"></div>
            </div>

        @endif
</div>

@endsection


<script>
    function Accept(OfferID) {
        alert(OfferID);
    }//END function Accept(OfferID)
</script>


<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">

    function Validation(OfferID) {
        var PaymentType = document.getElementById("PaymentType"+OfferID).value;
        var TotalAmount = document.getElementById("TotalAmount"+OfferID).value;
        // alert(TotalAmount);
        // alert(PaymentType);
        if(PaymentType =='-1') {
            document.getElementById('errorLabel').innerHTML="<?php echo "الرجاء اختيار طريقة الدفع"; ?>";
            document.getElementById('errorLabel').style.visibility = 'visible'; 
            document.getElementById('errorLabel').style.display = 'block';  
            // document.forms["Add_Form"+OfferID].elements["PaymentType"+OfferID].focus();
            return false;
        }
        else {
            document.getElementById('errorLabel').style.visibility = 'collapse'; 
            document.getElementById('errorLabel').style.display = 'none';
        }

        $(document).on('click', '#BuyService'+OfferID, function(e) {
        // alert("Monty");
        e.preventDefault();
        var form_data = new FormData($('#Form'+OfferID)[0]);

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
                    // $("#PaymentModel").css("display", "block");                
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
<style>
  .modal-content{
      border-radius: 10px;
      background-image: linear-gradient(30deg, rgba(255,255,255,0) 70%, rgba(255,255,255,0.2) 70%),linear-gradient(45deg, rgba(255,255,255,0) 75%, rgba(255,255,255,0.2) 75%),linear-gradient(60deg, rgba(255,255,255,0) 80%, rgba(255,255,255,0.2) 80%);
      background-color: silver;
      min-width: 20% !important;
      min-height: 20% !important;
      /*width: 50%;*/
      /*max-width: 20% !important;*/
      /*max-height: 20% !important;*/
      margin: 0 auto;
    }
   .card-body .row .custome_card{
      /*background-color: red;*/
      border-radius: 7px
    }
    .card-footer .row .custome_card{
      /*background-color: red;*/
      border-radius: 7px
    }
</style>