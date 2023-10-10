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
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/users') }}">المستخدمين</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/show_orders') }}">الخدمات</a>
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
    <button class="navbar-toggler" type="button" style="background-color: black;" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/users') }}">المستخدمين  </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/services') }}">الخدمات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/courses') }}">الدورات</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/posts') }}">المقالات </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/lawyers') }}">المحامين </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/providers') }}"> المكاتب والشركات </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/customers') }}">العملاء </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ URL::to('admin/dashboard') }}">إحصائيات </a>
        </li>  
      </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>