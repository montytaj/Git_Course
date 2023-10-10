<!-- 
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="img_avatar1.png" alt="Logo" style="width:40px;" class="rounded-pill">
    </a>
  </div>
</nav>
 -->

<!-- 

<nav class="navbar navbar-expand-sm navbar-light" style="background-color: #fff; padding: .5rem 1rem;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav" style="align-items: center !important;" >
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/users') }}">المستخدمين</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/users') }}">الخدمات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/users') }}">العملاء</a>
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">الإضافات </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ URL::to('admin/posts') }}">المقالات </a></li>
            <li><a class="dropdown-item" href="{{ URL::to('admin/courses') }}">الدورات</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('admin/services') }}">الخدمات</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav> -->


<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="{{asset('public/assets/img/1.png')}}" width="45px" height="45px"></a>
    <button class="navbar-toggler" type="button" style="background-color: ;" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <!-- <span class="navbar-toggler-icon"></span> -->
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/') }}"> الرئيسية </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/#FirstSection') }}">من نحن  </a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/#services-section') }}">الخدمات</a>
        </li>
        <li class="nav-item" style="display: none;">
          <a class="nav-link" href="#">الإستشارات القانونية</a>
        </li>
        <li class="nav-item" style="display: none;">
          <!-- <i class="fa fa-book fa-lg fa-fw" aria-hidden="true" style="top: 2px;font-size: 40px; color: #1198B6; margin-right: -15px;"></i> -->
          <a class="nav-link" href="{{ URL::to('/#courses-section') }}">الدورات</a>

        </li> 
        <li class="nav-item" style="display: none;">
          <a class="nav-link" href="{{URL::to('/#library-section')}}">المكتبة القانونية  </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('/#footer') }}">تواصل معنا  </a>
        </li>  
        <li class="nav-item">
           <a href="{{ URL::to('lawyer_login_form') }}" target="_blank">
               <button class="btn nav-link login_button" type="submit" > <span style=" font-size: 18px; color: black;">تسجيل الدخول  </span>  </button>
            </a>
        </li>
        <li class="nav-item dropdown" style="display: none;">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">الإضافات </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ URL::to('admin/posts') }}">المقالات </a></li>
            <li><a class="dropdown-item" href="{{ URL::to('admin/courses') }}">الدورات</a></li>
            <li><a class="dropdown-item" href="{{ URL::to('admin/services') }}">الخدمات</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br>

<style>
    .login_button{
          background: #403e35;
          border: 1px solid #ffffff;
          border-radius: 48px;
          /*width: 280px;*/
          /*height: 48px;*/
          width: 170px;
          /*font-weight: 20;*/
          /*line-height: 35px;*/
          text-align: center;
          color: #ffffff;
          display: block;
          /*margin-top: 35px;*/
          border-width: 1px;
          border-color: hsl(0, 0%, 100%);
          transition: all .2s ease-in-out;
          cursor: pointer;
          border-radius: 3rem;
          padding: 7px 24px;
          margin-right: 400px;
          max-height: 200px;
          font-size: 20px;
          /*color: black;*/
          /*color: red;*/
          padding-bottom: 9px;
          background-color: #ddc410;
    }
</style>