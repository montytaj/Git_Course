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

<br>
@if($CustomOrderOffers->Count() > 0)
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

                @php 
                  //var_dump($Offer->TotalAmount);
                @endphp

                <div class="col-xl-6" style="margin-bottom: 25px;"> 
                    <div class="card bg-primary" style="text-align: center; border-radius: 7px; border-width: 3px; padding:30px 50px 30px 50px;">
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
                        <div class="card-footer" style="display: nones; border-radius: 10px;">
                          <form method="POST"  id="Form{{$Offer->OfferID}}" enctype="multipart/form-data" style="">  
                                 @csrf
                                    <input type="hidden" name="ServiceID{{$Offer->OfferID}}" id="ServiceID{{$Offer->OfferID}}" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="BuyerName{{$Offer->OfferID}}" id="BuyerName{{$Offer->OfferID}}" value="{{$BuyerName}}">
                                    <input type="hidden" name="BuyerEmail{{$Offer->OfferID}}" id="BuyerEmail{{$Offer->OfferID}}" value="{{$BuyerEmail}}">
                                    <input type="hidden" name="BuyerPhone{{$Offer->OfferID}}" id="BuyerPhone{{$Offer->OfferID}}" value="{{$BuyerPhone}}">
                                    <input type="hidden" name="CurrentPrice{{$Offer->OfferID}}" id="CurrentPrice{{$Offer->OfferID}}" value="{{$Offer->TotalAmount}}">
                                    <input type="hidden" name="ServiceType{{$Offer->OfferID}}" id="ServiceType{{$Offer->OfferID}}" value="2">
                                    <input type="hidden" name="OfferID" id="OfferID" value="{{$Offer->OfferID}}">
                                    <input type="hidden" name="TotalAmount{{$Offer->OfferID}}" id="TotalAmount{{$Offer->OfferID}}" value="{{$Offer->TotalAmount}}">
                                      <div class="row">
                                          <div class="col-xl-3 card custome_card" style="min-height: 40px; max-height: 40px;"> طريقة الدفع   </div>

                                        <div class="col-xl-1"></div>
                                        <div class="col-xl-8 custome_card ">
                                                  <select class="registration-input" style="border-radius: 5px; width: 100%;" id="PaymentType{{$Offer->OfferID}}" name="PaymentType{{$Offer->OfferID}}">
                                                      <option value="-1">اختر طريقة الدفع</option>
                                                      <option value="1">Mada</option>
                                                      <option value="2">Visa</option>
                                                      <option value="3">MasterCard</option>
                                                  </select>
                                          </div>
                                    </div> 
                                    <button id="BuyService{{$Offer->OfferID}}" class="btn btn-success button" style="width:170px; border-radius:5px;" onclick="return Validation({{$Offer->OfferID}});"> قبول العرض  </button> 

                              </form>
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