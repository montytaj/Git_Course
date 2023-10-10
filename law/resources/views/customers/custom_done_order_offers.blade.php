@extends('customers.master')
@section('content')
<div class="container">    
  <div class="card ShowCard">
      @if($DoneCustomOrderOffers->Count() > 0)
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%" align="center">
                <thead>
                    <tr>
                        <td align="center"><b>#</b></td>
                        <td align="center"><b> الطلب  </b></td>
                        <td align="center"><b> تاريخ / زمن الطلب  </b></td>
                        <td align="center"><b> المجال  </b></td>
                        <td align="center"><b> الحالة  </b></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $Counter = 0;
                    @endphp
                    @foreach($DoneCustomOrderOffers as $CustomOrderOffer)
                       @php 
                          $Counter = $Counter +1; 
                          $StatusName = "";
                          if($CustomOrderOffer->Status == 1) {
                            $StatusName = "إنتظار ";
                          }//END if($CustomOrderOffer->Status == 1)
                          else if($CustomOrderOffer->Status == 2) {
                            $StatusName = "قيد الإجراء ";
                          }//END else if($CustomOrderOffer->Status == 2)
                          else if($CustomOrderOffer->Status == 3) {
                            $StatusName = "تم الإنتهاء ";
                          }//END else if($CustomOrderOffer->Status == 3)

                          $FieldName = "غير محدد";
                          $CityName = "غير محدد";
                          if(isset($CustomOrderOffer->lawyers['FieldID'])) {
                              $FieldName = $CustomOrderOffer->lawyers['FieldName'];
                          }//END if(isset($CustomOrderOffer->fields['FieldID']))
                          if(isset($CustomOrderOffer->lawyers['CityID'])) {
                              $CityName = $CustomOrderOffer->lawyers['CityName'];
                          }//END if(isset($CustomOrderOffer->lawyers['CityID']))
                        
                       @endphp
                       <tr>
                           <td align="center"> {{$Counter}} </td>
                           <td align="center"> {{$CustomOrderOffer->Description}} </td>
                           <td align="center"> {{$CustomOrderOffer->OfferDate}} <br> {{$CustomOrderOffer->OfferTime}} </td>
                           <td align="center"> {{$FieldName}} </td>
                           <td align="center"> {{$StatusName}} </td>
                       </tr>
                    @endforeach
                </tbody>  
            </table>
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

@endsection

  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables/datatable.css')}}">  
  <script src="{{ URL::asset('public/assets/js/datatables/datatable.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/datatables/datatable2.js') }}"></script>


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
