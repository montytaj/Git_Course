<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

 @include('layout.admin.master')
<br>
<div class="container">
    
@if($Orders->Count() > 0)
    <div class="card ShowCard">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%" align="center">
                <thead>
                    <tr>
                        <td align="center" width="5%"><b>#</b></td>
                        <td align="center" width="%34"><b> العميل   </b></td>
                        <td align="center" width="%40"><b>الطلب   </b></td>
                        <td align="center" width="7%"><b> تاريخ الطلب    </b></td>
                        <td align="center" width="7%"><b> زمن الطلب   </b></td>
                        <td align="center" width="7%"><b> المجال   </b></td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $Counter = 0;
                    @endphp
                    @foreach($Orders as $Order)
                        @php
                            $Counter = $Counter+1;
                            $FieldName = "غير محدد";
                            if($Order->FieldID != -1) {
                                $FieldName = $Order->fields['FieldName'];
                            }//END if($Order->FieldID != -1)              
                            $StatusName = "";
                            $StatusButton = "";
                            $StatusButtonColor = "";
                            if($Order->Status == 1) {
                                $StatusName = "إنتظار";
                            $StatusButton = "بدء  الإجراء";
                            $StatusButtonColor = "primary";
                            }//END if($Order->Status == 1)
                            else if($Order->Status == 2) {
                                $StatusName = "قيد الإجراء ";
                                $StatusButton = "إنهاء";
                                $StatusButtonColor = "warning";
                            }//END else if($Order->Status == 2)
                            else if($Order->Status == 3) {
                                $StatusName = "منتهي";
                                $StatusButton = "إخفاء";
                                $StatusButtonColor = "danger";
                            }//END else if($Order->Status == 3)
                        @endphp
                        <tr>
                            <td align="center">{{$Counter}}</td>
                            <td align="center">{{$Order->customers['FirstName']}} {{$Order->customers['LastName']}}</td>
                            <td align="center">{{$Order->Description}}</td>
                            <td align="center">{{$Order->OrderDate}}</td>
                            <td align="center">{{$Order->OrderTime}}</td>
                            <td align="center">{{$FieldName}}</td>
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
<script src="{{ URL::asset('assets/js/tinymce/tinymce.min.js') }}"></script>


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
