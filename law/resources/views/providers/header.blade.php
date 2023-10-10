<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="{{asset('assets/img/1.png')}}" width="45px" height="45px"></a>
    <button class="navbar-toggler" type="button" style=" ;" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon fa fa-bars"></span>
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