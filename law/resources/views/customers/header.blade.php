@php
  $CustomerData = session()->get('CustomerData');
  $FullName = $CustomerData->FirstName." ".$CustomerData->LastName;
@endphp
<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="{{asset('public/assets/img/1.png')}}" width="45px" height="45px"></a>
    <button class="navbar-toggler" type="button" style=" ;" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('customers/dashboard') }}"> <i class="fa fa-home fa-2x text-gray-300"></i>   </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/') }}"> الرئيسية </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('customers/custome_order/0') }}"> طلب خدمة جديدة </a>
        </li>
        <li class="nav-item">
          <p class="nav-link" href="#" style="color: ;">({{$FullName}})</p>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('customers/logout') }}" style="color: red;">تسجيل الخروج </a>
        </li>
      </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>