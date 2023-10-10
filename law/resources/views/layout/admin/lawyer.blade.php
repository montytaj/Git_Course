@extends('layout.admin.master') 

@section('content')

<div class="container">

<div style="padding-top: 10px;padding-bottom:30px;text-align: center;" class="container-fluid mt-4">
<form method="POST"  id="user_form" enctype="multipart/form-data">  
        @csrf

        <input type="hidden" name="LawyerID" id="LawyerID" value="{{$Lawyer->LawyerID}}">

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">الإسم</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->FirstName}} {{$Lawyer->LastName}}" disabled>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">التخصص</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->Specialism}}" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">المجال</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->fields['FieldName']}}" disabled>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">الخبرة</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->Experience}}" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">الجوال</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->PhoneNumber}}" disabled>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">البريد</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->Email}}" disabled>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-xl-3 col-form-label" style="text-align: left;">المؤهل</label>
                <div class="col-xl-9">
                  <input type="text" class="form-control registration-input" value="{{$Lawyer->qualification['QualificationName']}}" disabled>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-4"> </div>
        <div class="col-xl-4">
            <center>
                <button id="delete_btn" class="btn btn-danger button" style="width:100px;"> حذف </button> 
            </center>
        </div>
        <div class="col-xl-4"> </div>
    </div>

     <br>
    <div class="row" id="success_delete_msg" style="display: none;">
        <div class="form-group col-sm-3"></div>
        <div class="form-group col-sm-6">
            <div class="alert alert-success" role="alert">
               <center> تم الحذف بنجاح  </center>
           </div>
       </div>
       <div class="form-group col-sm-3"></div>
    </div>


</form>
</div>
</div>

@endsection

<script src="{{ URL::asset('public/assets/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript">
    $(document).on('click','#delete_btn', function(e){
            e.preventDefault();
            var LawyerID = document.getElementById("LawyerID").value;
            // alert(LawyerID);
            var url = '{{ route("delete_lawyer", ":LawyerID") }}';
            url = url.replace(':LawyerID', LawyerID);
            $.ajax({
                type : "GET",
                url : url,
                success: function(data){
                    if(data.status == true){
                        // alert(data.msg)
                        $('#success_delete_msg').show();
                        document.getElementById("user_form").reset();
                        setTimeout(function() { $("#success_msg").hide(); }, 2000);
                        window.setTimeout(function(){
                        window.location.href = "{{route('lawyers')}}";
                        }, 3000);
                    }
                }
            });

    });

</script>
