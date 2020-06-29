@include('header')
<body class="hold-transition sidebar-mini">
  <div  class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fi fi-nav-icon-grid-a"></i></a>
  </li>
</ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<div class="sidebar">
  <div class="user-panel  mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle elevation-0" alt="User Image">
    </div>
    <div class="info">
      <a href="{{ url('/') }}" class="d-block">{{ Auth::user()->name}}</a>
    </div>
  </div>
  {{--  navegation  --}}
  @include('navegation')
  {{--  end  --}}
</div>
</aside>
<div class="content-wrapper">
<div class="content-header">
  <div class="container-fluid">
    <div class="row" id="app">
        @yield('measure')
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">@yield('titlepanel')</h3>
          </div>
          <div class="card-body">
          @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
 <footer class="main-footer">
  <div class="float-right d-none d-sm-inline">
    <span class="float-right badge bg-primary">{{ Auth::user()->email}}</span>
  </div>
</footer>
</div> 
@include('footer')