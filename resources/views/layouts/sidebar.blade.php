@section('sidebar')
@php
$role = Auth::user()->role;
$role = explode(', ', $role);
@endphp
<div class="sidebar" data-color="green" data-background-color="black" data-image="{{asset('public/img/sidebar-1.jpg')}}">
        <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
        -->
    <div class="logo">
        <a href="{{url('/')}}" class="simple-text logo-mini">S</a>
        <a href="{{url('/')}}" class="simple-text logo-normal">SIP</a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset('public/img/new_logo.png')}}" />
            </div>
            <div class="user-info">
                <a data-toggle="collapse" href="#collapseExample" class="username">
                    <span>{{ucwords(Auth::user()->nama)}}</span>
                </a>
            </div>
        </div>
    <ul class="nav">
        <li class="nav-item @yield('dashboardStatus') ">
            <a class="nav-link" href="{{url('/')}}">
                <i class="material-icons">dashboard</i>
                <p> Dashboard </p>
            </a>
        </li>
        <li class="nav-item @yield('pegawaiStatus')">
            <a class="nav-link" href="{{url('/pegawai')}}">
                <i class="material-icons">group</i>
                <p> Pegawai </p>
            </a>
        </li>
    </ul>
        </div>
            <div class="sidebar-background"></div>
        </div>
@endsection