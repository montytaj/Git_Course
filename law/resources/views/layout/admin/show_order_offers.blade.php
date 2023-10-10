<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

 @include('layout.admin.master')
<br>
<div class="container">
    
@if($Offers->Count() > 0)
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
                        <td align="center" width="%15"><b> العميل   </b></td>
                        <td align="center" width="%15"><b> المحامي    </b></td>
                        <td align="center" width="40%"><b> العرض   </b></td>
                        <td align="center" width="10%"><b> زمدة الإنجاز   </b></td>
                        <td align="center" width="10%"><b> سعر  المحامي  </b></td>
                        <td align="center">حذف</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $Counter = 0;
                    @endphp
                    @foreach($Offers as $Offer)
                        @php
                            $Counter = $Counter+1;
                           
                        @endphp
                        <tr>
                            <td align="center">{{$Counter}}</td>
                            <td align="center">{{$Offer->customers['FirstName']}} {{$Offer->customers['LastName']}}</td>
                            <td align="center">{{$Offer->lawyers['FirstName']}} {{$Offer->customers['LastName']}}</td>
                            <td align="center">{{$Offer->Description}}</td>
                            <td align="center">{{$Offer->Execution_Period}} ساعة </td>
                            <td align="center">{{$Offer->Price}}</td>
                            <td align="center"><a href="{{route('show_offer',$Offer->OfferID)}}" role="button"  class="btn btn-danger button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> حذف </a></td>
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
