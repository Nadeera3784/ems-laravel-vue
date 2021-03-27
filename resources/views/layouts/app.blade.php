<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>

<div class="d-flex" id="wrapper">

    <div class="border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">EMS</div>
            <ul class="navbar-nav sidebar accordion" id="accordionSidebar">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('em.index')}}">
                  <span>Employee Management</span>
              </a>
          </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <span>System Management</span>
                </a>
                <div id="collapseUtilities" class="collapse @if (\Request::is('sm/*'))  {{'show'}}  @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @if (\Request::is('sm/country')) {{'active'}} @endif" href="{{route('sm.country')}}">Country</a>
                        <a class="collapse-item @if (\Request::is('sm/state')) {{'active'}} @endif" href="{{route('sm.state')}}">State</a>
                        <a class="collapse-item @if (\Request::is('sm/city')) {{'active'}} @endif" href="{{route('sm.city')}}">City</a>
                        <a class="collapse-item @if (\Request::is('sm/department')) {{'active'}} @endif" href="{{route('sm.department')}}">Department</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <span>User management</span>
                </a>
                <div id="collapsePages" class="collapse @if (\Request::is('um/*'))  {{'show'}}  @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item @if (\Request::is('um/user')) {{'active'}} @endif" href="{{route('um.user')}}">User</a>
                        <a class="collapse-item @if (\Request::is('um/role')) {{'active'}} @endif" href="{{route('um.role')}}">Role</a>
                        <a class="collapse-item" href="#">Permission</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->first_name . " " . Auth::user()->last_name }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
          @include('layouts.alerts')
          @yield('content')
      </div>
    </div>
  </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>
</html>
