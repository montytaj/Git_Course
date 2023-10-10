@extends('customers.master') 

@section('content')

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
    <center>
        <div class="alert alert-danger" style="visibility:collapse;display: none;" id="errorLabel" style=""> </div>
    </center>
    @php if(isset($CustomOrder)) {  @endphp
        <form method="POST"  id="Add_Form" enctype="multipart/form-data">  
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
                    <td align="center"><b> عرض   </b></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $Counter = 0;
                @endphp
                @foreach($CustomOrderOffers as $Offer)
                   @php 
                      $Counter = $Counter +1;
                     
                   @endphp
                   <tr>
                       <td align="center"> {{$Counter}} </td>
                       <td align="center"> 
                          {{$Offer->lawyers['FirstName']}} {{$Offer->lawyers['LastName']}} 
                       </td>
                       <td align="center"> {{$Offer->Price}} </td>
                       <td align="center"> {{$Offer->OfferDate}} <br> {{$Offer->OfferTime}} </td>
                       <td align="center"> {{$Offer->lawyers->fields['FieldName']}} </td>
                       <td align="center"><a href="{{route('show_customer_offer_details',$Offer->OfferID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> تفاصيل </a></td>
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

@endsection
