@extends('customers.master')
@section('content')
<div class="container">    
  <div class="card ShowCard">
      @if($CustomOrders->Count() > 0)
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%" align="center">
                <thead>
                    <tr>
                        <td align="center"><b>#</b></td>
                        <td align="center"><b> الطلب  </b></td>
                        <td align="center"><b> تاريخ / زمن الطلب  </b></td>
                        <td align="center"><b> المجال  </b></td>
                        <td align="center"><b> الحالة  </b></td>
                        <td align="center"><b> العروض  </b></td>
                        <td align="center"><b> حذف  </b></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $Counter = 0;
                    @endphp
                    @foreach($CustomOrders as $CustomOrder)
                       @php 
                          $Counter = $Counter +1; 
                          $StatusName = "";
                          if($CustomOrder->Status == 1) {
                            $StatusName = "إنتظار ";
                          }//END if($CustomOrder->Status == 1)
                          else if($CustomOrder->Status == 2) {
                            $StatusName = "قيد الإجراء ";
                          }//END else if($CustomOrder->Status == 2)
                          else if($CustomOrder->Status == 3) {
                            $StatusName = "تم الإنتهاء ";
                          }//END else if($CustomOrder->Status == 3)

                          $FieldName = "غير محدد";
                          $CityName = "غير محدد";
                          if(isset($CustomOrder->fields['FieldID'])) {
                              $FieldName = $CustomOrder->fields['FieldName'];
                          }//END if(isset($CustomOrder->fields['FieldID']))
                          if(isset($CustomOrder->cities['CityID'])) {
                              $CityName = $CustomOrder->cities['CityName'];
                          }//END if(isset($CustomOrder->cities['CityID']))
                        
                       @endphp
                       <tr>
                           <td align="center"> {{$Counter}} </td>
                           <td align="center"> {{$CustomOrder->Description}} </td>
                           <td align="center"> {{$CustomOrder->OrderDate}} <br> {{$CustomOrder->OrderTime}} </td>
                           <td align="center"> {{$FieldName}} </td>
                           <td align="center"> {{$StatusName}} </td>
                           <td align="center"><a href="{{route('show_customer_custome_order',$CustomOrder->CustomOrderID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> العروض </a></td>
                          <td align="center">
                              <button id="Delete" class="btn btn-danger button" style="width:100px;" onclick="return DeleteCustomeOrder({{$CustomOrder->CustomOrderID}});"> حذف  </button> 
                          </td>
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

<br>

    <div class="row" id="success_delete_msg" style="display: none;">
      <div class="form-group col-sm-3"></div>
      <div class="form-group col-sm-6">
          <div class="alert alert-success" role="alert">
             <center> تم حذف  طلبك  بنجاح  </center>
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


</div>

@endsection

  <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/datatables/datatable.css')}}">  
  <script src="{{ URL::asset('public/assets/js/datatables/datatable.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/datatables/datatable2.js') }}"></script>


<script>

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

<script >

function DeleteCustomeOrder(CustomOrderID)
{
    var CustomOrderID = CustomOrderID;
    // alert(CustomOrderID);
    var url = '{{ route("delete_customer_custome_order", ":CustomOrderID") }}';
    url = url.replace(':CustomOrderID', CustomOrderID);    

   $.ajax({
    type : "GET",
    url : url,
    success: function(data) {
                if(data.status == true){
                    // alert("Deleted");
                    $("#success_delete_msg").show();
                    setTimeout(function() {
                        location.reload();
                        }, 2000);
                    }
                else if(data.status == false){
                    $("#faild_delete_msg").show();
                    setTimeout(function() { $("#faild_delete_msg").hide();
                    location.reload();
                        }, 2000);
                    }    
                }
   });
}//END function DeleteCustomeOrder(CustomOrderID)
</script>