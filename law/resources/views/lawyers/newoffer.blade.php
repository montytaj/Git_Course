 @extends('lawyers.master')
      @section('content')
      @php

        $DisplayTwo = "block";
        $Display = "none";
        if(!empty($LessPriceOffer)){
            $LessPricePrice = $LessPriceOffer->Price."    "."ريال"  ;
            $LessPriceTime = $LessPriceOffer->Execution_Period . "ساعة" ;
        }
        else {
            $LessPricePrice = "لا يوجد عرض"  ;
            $LessPriceTime = "لا يوجد عرض"  ;
        }
        if(!empty($LessTimeOffer)){
            $LessTimeTime = $LessTimeOffer->Execution_Period."    "."ساعة";
            $LessTimePrice = $LessTimeOffer->Price."    "." ريال ";
        }
        else {
            $LessTimeTime = "لا يوجد عرض"  ;
            $LessTimePrice = "لا يوجد عرض"  ;
        }
      @endphp
      @if(isset($CustomOrder))
                
    <br>
        <div class="container">        
            <div class="card ShowCard">

              <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-4" style="margin-bottom: 25px;"> 
                    <div class="card bg-primary" style="text-align: center; border-radius: 7px;">
                        <div class="card-header" style="">
                            <button id="Update" class="btn btn-secondary button" style="width:70%; margin:0 auto;margin-top: -18px; border-radius: 7px; background-color: white;max-height: ; border-color:#06BBCC; border-width: 2px;  color: #06BBCC"> أقل عرض سعر  </button>
                        </div>
                        <div class="card-body">
                            {{$LessPricePrice}}  
                            <br><br>
                            مدة الإنجاز : {{$LessPriceTime}} 
                        </div>
                        <div class="card-footer" style="display: none;">Footer</div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
                <div class="col-xl-4"  style="margin-bottom: 25px;">
                    <div class="card bg-primary" style="text-align: center; border-radius: 7px;">
                        <div class="card-header" style="">
                            <button id="Update" class="btn btn-secondary button" style="width:70%; margin:0 auto;margin-top: -18px; border-radius: 7px; background-color: white;max-height: ; border-color:#06BBCC; border-width: 2px;  color: #06BBCC"> أقل  مدة للإنجاز   </button>
                        </div>
                        <div class="card-body">
                            {{$LessTimeTime}} 
                            <br><br>
                            السعر : {{$LessTimePrice}}
                        </div>
                        <div class="card-footer" style="display: none;">Footer</div>
                    </div>
                </div>
                <div class="col-xl-1"></div>
              </div>



                @php
                      $PricePlusPlatformCommission = "";
                      $Price = "";
                      $Description = "";
                      $UpdateID = "";
                      $Status = "";
                      $Execution_Period = "";

                @endphp
                  @php
                      //var_dump($CustomOrderLawyer->Price);
                      if(!empty($CustomOrderLawyer)) {
                        $Price = $CustomOrderLawyer->Price;
                        $PricePlusPlatformCommission = $CustomOrderLawyer->PlatformCommission;
                        $PricePlusPlatformCommission1 = ($Price * $PricePlusPlatformCommission)/100;
                        $PricePlusPlatformCommission = ($Price - $PricePlusPlatformCommission1);
                        $Description = $CustomOrderLawyer->Description;
                        $Execution_Period = $CustomOrderLawyer->Execution_Period;
                        $UpdateID = $CustomOrderLawyer->OfferID;
                        $Status = $CustomOrderLawyer->Status;
                        

                        if($Status == 2) {
                            $Display = "block";
                            $DisplayTwo = "none";
                        }//END if($Status == 2)
                      }//END if(isset($Price))
                      //var_dump($Status);

                          $FieldName = "غير محدد";
                          $CityName = "غير محدد";
                          if(isset($CustomOrder->fields['FieldID'])) {
                              $FieldName = $CustomOrder->fields['FieldName'];
                          }//END if(isset($CustomOrder->fields['FieldID']))
                          if(isset($CustomOrder->cities['CityID'])) {
                              $CityName = $CustomOrder->cities['CityName'];
                          }//END if(isset($CustomOrder->cities['CityID']))



                  @endphp
                    <div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
                        
                          <div class="row">
                            <div class="col-xl-3"> </div>
                            <div class="col-xl-6">
                                <div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style=""> </div>
                            </div>
                            <div class="col-xl-3"> </div>
                        <form method="POST"  id="Add_Form" enctype="multipart/form-data">  
                            @csrf
                            <input type="hidden" name="CustomOrderID" id="CustomOrderID" value="{{$CustomOrder->CustomOrderID}}">
                            <input type="hidden" name="CustomerID" id="CustomerID" value="{{$CustomOrder->CustomerID}}">
                            
                            <input type="hidden" name="UpdateID" id="UpdateID" value="{{$UpdateID}}">
                        <div class="row" style="display: none;">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-xl-2 col-form-label" style="text-align: right;">وصف الخدمة</label>
                                    <div class="col-xl-10">
                                      <textarea class="form-control " style="height: 100px; border-radius: 10px; margin-bottom: 10px;"  disabled>{{$CustomOrder->Description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3"></div>
                        </div>


                        <div class="row" style="display: none;">
                            <div class="col-xl-3"></div>
                            <div class="col-xl-6">
                                <div class="form-group row">
                                    <label class="col-xl-2 col-form-label" style="text-align: right;">المجال</label>
                                    <div class="col-xl-10">
                                        <input class="registration-input" type="" value="{{$FieldName}}" disabled>
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
                                        <input class="registration-input" type="" value="{{$CityName}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3"></div>
                        </div>
                        
                        <hr style="width: 100%;height: 5px; background-color: #4ddd45; display: none;">
                        <input type="hidden" name="PlatformCommission" id="PlatformCommission" value="{{$Settings->PlatformCommission}}">
                        <input type="hidden" name="Tax" id="Tax" value="{{$Settings->Tax}}">
                        <center>
                            <span  id="AddOffer" class="btn btn-success button" style="width:200px; border-radius: 5px; display: {{$DisplayTwo}};" onclick="ShowForm();"> تقديم عرض جديد  </span>
                        </center>



                          <div id="InputsForm" style="display: {{$Display}};">
                            <div class="row">
                              <div class="col-xl-1"></div>
                                <div class="col-xl-5">
                                    <div class="form-group row">
                                        <label class="col-xl-2 col-form-label" style="text-align: right;">وصف الخدمة</label>
                                        <div class="col-xl-10">
                                          <textarea class="form-control " style="height: 100px; border-radius: 10px; margin-bottom: 10px;" name="Description" id="Description">{{$Description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group row">
                                        <label class="col-xl-2 col-form-label" style="text-align: right;">زمن الإنجاز</label>
                                        <div class="col-xl-10">
                                          <input class="registration-input" type="number" name="Execution_Period" id="Execution_Period" value="{{$Execution_Period}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1"></div>
                            </div>

                            <div class="row">
                                <div class="col-xl-1"></div>
                                <div class="col-xl-5">
                                    <div class="form-group row">
                                        <label class="col-xl-2 col-form-label" style="text-align: right;">السعر </label>
                                        <div class="col-xl-10">
                                            <input class="registration-input" type="" name="Price" id="Price" onkeyup="NewPrice(this.value);" value="{{$Price}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group row">
                                        <label class="col-xl-2 col-form-label" style="text-align: right;">السعر بعد الخصم</label>
                                        <div class="col-xl-10">
                                            <input class="registration-input" type="" name="PricePlusPlatformCommission" id="PricePlusPlatformCommission" value="{{$PricePlusPlatformCommission}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-1"></div>
                            </div>
                      
                        @if($Status == 1 or $Status == "")
                            <div class="row">
                                <div class="col-xl-4"> </div>
                                <div class="col-xl-4">
                                    <center>
                                        <button id="Save" class="btn btn-success button" style="width:200px; border-radius: 5px;" onclick="return validation();"> تقديم عرض جديد  </button> 
                                    </center>
                                </div>
                                <div class="col-xl-4"> </div>
                            </div>
                        </div>
                        @elseif($Status == 2)
                            <div class="row">
                                <div class="col-xl-4"> </div>
                                <div class="col-xl-4">
                                        <center>
                                            <button id="Update" class="btn btn-success button" style="width:100px;" onclick="return validation();"> تعديل </button>
                                            <button id="Delete" class="btn btn-danger button" style="width:100px;" onclick="return validation();"> حذف  </button> 
                                        </center>
                                         </div>
                                <div class="col-xl-4"> </div>
                            </div>
                        @endif

                  <br>
                        <!-- ###################################################################################### -->
                        <div class="row" id="success_add_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-success" role="alert">
                                   <center> تم   إضافة العرض بنجاح </center>
                               </div>
                           </div>
                           <div class="form-group col-sm-3"></div>
                        </div>

                        <div class="row" id="faild_add_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-danger" role="alert">
                                   <div id="dublicate_message_error">
                                       <center> لم  تتم إضافة العرض بنجاح   </center>
                                   </div>
                               </div>
                           </div>
                           <div class="form-group col-sm-3"></div>
                        </div>
                        <!-- ######################################################################################## -->
                        <!-- ###################################################################################### -->
                        <div class="row" id="success_update_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-success" role="alert">
                                   <center> تم  تعديل عرضك بنجاح   </center>
                               </div>
                           </div>
                           <div class="form-group col-sm-3"></div>
                        </div>

                        <div class="row" id="faild_update_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-danger" role="alert">
                                       <center> لم يتم  تعديل عرضك بنجاح  </center>
                                   </div>
                               </div>
                           </div>
                           <div class="form-group col-sm-3"></div>
                        </div>
                        <!-- ######################################################################################## -->
                         <!-- ###################################################################################### -->
                        <div class="row" id="success_delete_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-success" role="alert">
                                   <center> تم حذف عرضك بنجاح  </center>
                               </div>
                           </div>
                           <div class="form-group col-sm-3"></div>
                        </div>

                        <div class="row" id="faild_delete_msg" style="display: none;">
                            <div class="form-group col-sm-3"></div>
                            <div class="form-group col-sm-6">
                                <div class="alert alert-danger" role="alert">
                                       <center> لم  تتم  عملية الحذف  بنجاح   </center>
                                   </div>
                               </div>
                           <div class="form-group col-sm-3"></div>
                        </div>
                           
                        @if($CustomOrderOffers->Count() > 0)
                        <br>
                      </form>
                    </div>
                        <div class="container" style="display: none;">  
                             <div class="card bg-primary page_title">
                                <div class="card-body"><center> <div style="font-size: 20px;font-weight: 800px; " ><b> العروض   </b> </div> </center></div>
                              </div>
                          <div class="card ShowCard">
                     
                              <div class="table-responsive">
                                <table id="myTable" class="table table-striped" style="width:100%" align="center">
                                    <thead>
                                        <tr>
                                            <td align="center"><b>#</b></td>
                                            <td align="center"><b> مقدم العرض   </b></td>
                                            <td align="center"><b> السعر   </b></td>
                                            <td align="center"><b> تاريخ / زمن  التقديم   </b></td>
                                            <td align="center"><b> المجال  </b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $Counter = 0;
                                        @endphp
                                        @foreach($CustomOrderOffers as $Offer)
                                           @php 
                                              $Counter = $Counter +1;
                                              $TRColor = "";
                                              if($Offer->lawyers['LawyerID'] == $LawyerID) {
                                                  $TRColor = "silver";
                                              }//END if($Offer->lawyers['LawyerID'] == $LawyerID) 

                                           @endphp
                                           <tr style="background-color:{{$TRColor}}">
                                               <td align="center"> {{$Counter}} </td>
                                               <td align="center"> 
                                                  {{$Offer->lawyers['FirstName']}} {{$Offer->lawyers['LastName']}} 
                                               </td>
                                               <td align="center"> {{$Offer->Price}} </td>
                                               <td align="center"> {{$Offer->OfferDate}} <br> {{$Offer->OfferTime}} </td>
                                               <td align="center"> {{$Offer->lawyers->fields['FieldName']}} </td>
                                           </tr>
                                        @endforeach
                                    </tbody>  
                                </table>
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

                        </div>
                        <!-- ######################################################################################## -->
</div>
</div>

                    </div>
                @else
                  <br>
                    <div class="row" >
                        <div class="form-group col-sm-12">
                            <div class="alert alert-danger" role="alert">
                               <center> عفواً ليس لديك طلبات   </center>
                           </div>
                       </div>
                    </div>
                @endif

            </div>
        </div>

@endsection
  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables/datatable.css')}}">  
  <script src="{{ URL::asset('public/assets/js/datatables/datatable.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/datatables/datatable2.js') }}"></script>



<script>

  function ShowForm() {
    document.getElementById("InputsForm").style.display = 'block';
    document.getElementById("AddOffer").style.display = 'none';
  }//END function ShowForm()


  function NewPrice(PricePlusPlatformCommission) {
      var PlatformCommission = <?php echo $Settings->PlatformCommission; ?>
      // alert(PricePlusPlatformCommission);
      var NewPrice1 = (PricePlusPlatformCommission * PlatformCommission) / 100;
      var NewPrice = (PricePlusPlatformCommission - NewPrice1);
      if(PricePlusPlatformCommission > 10) {
          document.getElementById("PricePlusPlatformCommission").value = NewPrice;
      }//END if(NewPrice > 10)
      else {
          document.getElementById("PricePlusPlatformCommission").value = "";
      }
  }//END function NewPrice(PricePlusPlatformCommission)

  function validation() {  

    
  var Description = document.getElementById("Description").value;
  var Price = document.getElementById("Price").value;
  
  if(Description.length < 20 || Description.length > 150 ) {
      document.getElementById('errorLabel').innerHTML = "<?php echo " وصف الطلب يجب أن يتكون من  20 حرفاً على الأقل  ولا يزيد عن 150 حرفاً"; ?>";
      document.getElementById('errorLabel').style.visibility = 'visible';
      document.getElementById('errorLabel').style.display = 'block';
      document.forms["Add_Form"].elements["Description"].focus();
      return false;
  }//END if(Description.length < 50 || Description.length > 150 )
  if(Price < 50) {
      document.getElementById('errorLabel').innerHTML = "<?php echo " سعر الخدمة يجب أن لا يقل عن  50 ريال  " ?>";
      document.getElementById('errorLabel').style.visibility = 'visible';
      document.getElementById('errorLabel').style.display = 'block';
      document.forms["Add_Form"].elements["Price"].focus();
      return false;
  }//END if(Price < 15)
  else {
    document.getElementById('errorLabel').style.visibility = 'collapse';
    document.getElementById('errorLabel').style.display = 'none';
  }
    $(document).on('click','#Save', function(e){
        e.preventDefault();

        var form_data = new FormData($('#Add_Form')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('add_new_offer')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_add_msg").show();
                    document.getElementById("Add_Form").reset();
                    setTimeout(function() { $("#success_add_msg").hide();
                    location.reload();
                        }, 2000);
                    }
                else if(data.status == false && data.errorCode == 1062){
                  // alert("Monty");
                    document.getElementById('dublicate_message_error').innerHTML = "لا يمكنك إضافة عرض جديد لأن لديك عرض مسبقاً ";
                    $("#faild_add_msg").show();
                    setTimeout(function() { $("#faild_add_msg").hide();
                        location.reload();
                        }, 2000);
                    }
                else if(data.status == false){
                    $("#faild_add_msg").show();
                    setTimeout(function() { $("#faild_add_msg").hide();
                    location.reload();
                        }, 2000);
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
    // #########################################################################################################
    // #########################################################################################################
    $(document).on('click','#Update', function(e){
        e.preventDefault();

        var form_data = new FormData($('#Add_Form')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('update_offer')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_update_msg").show();
                    document.getElementById("Add_Form").reset();
                    setTimeout(function() { $("#success_update_msg").hide();
                    location.reload();
                        }, 2000);
                    }
                else if(data.status == false){
                    $("#faild_add_msg").show();
                    setTimeout(function() { $("#faild_update_msg").hide();
                    location.reload();
                        }, 2000);
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

    // #########################################################################################################
    // #########################################################################################################
    $(document).on('click','#Delete', function(e){
        e.preventDefault();

        var form_data = new FormData($('#Add_Form')[0]);
        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('delete_offer')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data) {
                if(data.status == true){
                    $("#success_delete_msg").show();
                    document.getElementById("Add_Form").reset();
                    setTimeout(function() { $("#success_delete_msg").hide();
                    location.reload();
                        }, 2000);
                    }
                else if(data.status == false){
                    $("#faild_add_msg").show();
                    setTimeout(function() { $("#faild_delete_msg").hide();
                    location.reload();
                        }, 2000);
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
                $('#myTable').dataTable(
                    {

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

        }
                    
                    );
  

        });
</script>


<style>
  /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>