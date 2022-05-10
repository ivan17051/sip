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
        <a href="{{url('/')}}" class="simple-text logo-mini">K</a>
        <a href="{{url('/')}}" class="simple-text logo-normal">Koperasi</a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset('public/img/logo.png')}}" />
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
        <li class="nav-item @yield('userStatus')">
            <a class="nav-link" href="{{url('/user')}}">
                <i class="material-icons">people</i>
                <p> User </p>
            </a>
        </li>
        <li class="nav-item @yield('kategoriStatus')">
            <a class="nav-link" href="{{url('/kategori')}}">
                <i class="material-icons">category</i>
                <p> Kategori </p>
            </a>
        </li>
        <li class="nav-item @yield('akunStatus')">
            <a class="nav-link" href="{{url('/akun')}}">
                <i class="material-icons">account_tree</i>
                <p> Akun </p>
            </a>
        </li>
    </ul>
        </div>
            <div class="sidebar-background"></div>
        </div>
@endsection