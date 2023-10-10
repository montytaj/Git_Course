@extends('layout.admin_master') 

@section('content')

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">

        <?php $user_data = session()->get('user_data') ?>


<div class="card bg-light table_card">
    <div class="card-body">

    <form method="POST"  id="user_form" enctype="multipart/form-data">  
        @csrf
        <input type="hidden" name="user_id" value="{{$user_data->id}}">

    <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control" type="password" name="old_user_password"  placeholder="كلمة المرور الحالية"
            value="">  
            <small id="user_password_error" class="form-text text-danger" style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>

        <div class="row">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <input class="form-control" type="password" name="new_user_password"  placeholder="كلمة المرور الجديدة"
            value="">  
            <small id="user_password_error" class="form-text text-danger" style="text-align: right;"></small>

        </div>
        <div class="form-group col-sm-3">
            <div><!-- SPACE ONLY --></div>
        </div>
    </div>

        <center>
        <button id="save_data" class="btn btn-success" style="font-size:17px;font-weight:bold; width:70px;">تغير   </button>                 
    </center>

    <br>
    <div class="row" id="success_msg" style="display: none;">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert">
               <center> تم التعديل  بنجاح   </center>
           </div>
       </div>

       <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>

    <div class="row" id="worrning_msg" style="display: none;">
        <div class="form-group col-sm-3">
            <span><!-- SPACE ONLY  --></span>
        </div>

        <div class="form-group col-sm-6">
            <div class="alert alert-danger" role="alert">
               <center> كلمة المرور القديمة غير صحيحة  </center>
           </div>
       </div>

       <div class="form-group col-sm-3">
        <span><!-- SPACE ONLY  --></span>
    </div>
</div>


</form>
</div>
</div>

</div>
</div>

@endsection






@section('scripts')
<script>
    $(document).on('click','#save_data', function(e){
        e.preventDefault();

        var form_data = new FormData($('#user_form')[0]);

        $.ajax({
            type: "post",
            enctype : "multipart/form-data",
            url: "{{route('change_user_password')}}",
            data: form_data,
            processData : false,
            contentType : false,
            cache :false,
            success: function(data){
                if(data.status == true){
                // alert(data.msg)
                
                $("#success_msg").show();
                document.getElementById("user_form").reset();
                setTimeout(function() { $("#success_msg").hide(); }, 5000);
            }
            else if(data.status == false){
                // alert(data.msg)
                
                $("#worrning_msg").show();
                document.getElementById("user_form").reset();
                setTimeout(function() { $("#worrning_msg").hide(); }, 5000);
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

@stop
