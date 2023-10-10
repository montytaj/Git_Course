@php
    $ActiveCustomOrder = App\Http\Controllers\LawyerController::count_active_orders();
      $LawyerData = session()->get('LawyerData');
    $FullName = $LawyerData->FirstName." ".$LawyerData->LastName;
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
          <a class="nav-link" href="{{ URL::to('lawyers/dashboard') }}"> <i class="fa fa-home fa-2x text-gray-300"></i>   </a>
        </li>
        <li class="nav-item" style="display: none;">
          <a class="nav-link" href="{{ URL::to('lawyers/active_orders') }}">طلبات جديدة  ({{$ActiveCustomOrder}}) </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('lawyers/lawyer_offers') }}">عروضي</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('lawyers/lawyer_done_offers') }}">المنجز</a>
        </li>
        <li class="nav-item">
          <p class="nav-link" href="#" style="color: ;">( المحامي : {{$FullName}})</p>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('lawyers/logout') }}" style="color: red;">تسجيل الخروج </a>
        </li>
          
      </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>