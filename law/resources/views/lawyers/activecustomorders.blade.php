 @extends('lawyers.master')

      @section('content')
              <br>
              <div class="container">    
                    <div class="card bg-primary page_title">
                       <div class="card-body"><center> <div style="font-size: 20px;font-weight: 800px; " ><b> الطلبات   </b> </div> </center></div>
                    </div>
                  <div class="card ShowCard">
                    @if($ActiveCustomOrders->Count() > 0)
                      <div class="table-responsive">
                          <table id="myTable" class="table table-striped" style="width:100%" align="center">
                              <thead>
                                  <tr>
                                      <td align="center"><b>#</b></td>
                                      <td align="center"><b> العميل  </b></td>
                                      <td align="center"><b> الطلب  </b></td>
                                      <td align="center"><b> تاريخ  و  زمن الطلب  </b></td>
                                      <td align="center"><b> المجال  </b></td>
                                      <td align="center"><b> العروض  </b></td>
                                  </tr>
                              </thead>
                              <tbody>
                                  @php
                                      $Counter = 0;
                                  @endphp
                                  @foreach($ActiveCustomOrders as $ActiveCustomOrder)
                                     @php 
                                        $Counter = $Counter +1; 
                                        $FieldName = "غير محدد";
                                        $CityName = "غير محدد";
                                        if(isset($ActiveCustomOrder->fields['FieldID'])) {
                                            $FieldName = $ActiveCustomOrder->fields['FieldName'];
                                        }//END if(isset($ActiveCustomOrder->fields['FieldID']))
                                        if(isset($ActiveCustomOrder->cities['CityID'])) {
                                            $CityName = $ActiveCustomOrder->cities['CityName'];
                                        }//END if(isset($ActiveCustomOrder->cities['CityID']))
                                     @endphp
                                     <tr>
                                         <td align="center"> {{$Counter}} </td>
                                         <td align="center"> {{$ActiveCustomOrder->customers['FirstName']}} {{$ActiveCustomOrder->customers['LastName']}} </td>
                                         <td align="center"> {{$ActiveCustomOrder->Description}} </td>
                                         <td align="center"> {{$ActiveCustomOrder->OrderDate}} <br> {{$ActiveCustomOrder->OrderTime}} </td>
                                         <td align="center"> {{$FieldName}} </td>
                                         <td align="center"><a href="{{route('newoffer',$ActiveCustomOrder->CustomOrderID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> العروض  </a></td>
                                     </tr>
                                  @endforeach
                              </tbody>  
                          </table>
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
