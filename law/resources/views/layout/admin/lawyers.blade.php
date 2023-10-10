<html>
<body>

 @include('layout.admin.master')
<br>
<div class="container">
    
@if($Lawyers->Count() > 0)
    <div class="card ShowCard">
        <div class="table-responsive">
            <table id="myTable" class="table table-striped" style="width:100%" align="center">
                <thead>
                    <tr>
                        <td align="center"><b>#</b></td>
                        <td align="center"><b> الإسم  </b></td>
                        <td align="center"><b>التخصص  </b></td>
                        <td align="center"><b> الخبرة  </b></td>
                        <td align="center"><b> الجوال  </b></td>
                        <td align="center"><b> المؤهل  </b></td>
                        <td align="center"><b>  المجال   </b></td>
                        <td align="center"><b>  عرض   </b></td>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $Counter = 0;
                    @endphp
                    @foreach($Lawyers as $Lawyer)
                       @php $Counter = $Counter +1; @endphp
                       <tr>
                           <td align="center"> {{$Counter}} </td>
                           <td align="center"> {{$Lawyer->FirstName}} {{$Lawyer->LastName}} </td>
                           <td align="center"> {{$Lawyer->Specialism}} </td>
                           <td align="center"> {{$Lawyer->Experience}} </td>
                           <td align="center"> {{$Lawyer->PhoneNumber}} </td>
                           <td align="center"> {{$Lawyer->qualification['QualificationName']}} </td>
                           <td align="center"> {{$Lawyer->fields['FieldName']}} </td>
                           <td align="center"><a href="{{route('show_lawyer',$Lawyer->LawyerID)}}" role="button"  class="btn btn-primary button"  value="" style="margin-right: 2px; margin-left: 2px; margin-top: 2px; margin-bottom: 2px;"> عرض </a></td>
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
