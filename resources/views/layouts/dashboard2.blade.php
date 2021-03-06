<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="{{asset('dist/favicon.ico')}}" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('dist/favicon.ico')}}" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>{{ config('app.name', 'ATL') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{asset('dist/assets/js/require.min.js')}}"></script>
    <script>
        requirejs.config({
            baseUrl: '/dist/'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="{{asset('dist/assets/css/dashboard.css')}}" rel="stylesheet" />
    <script src="{{asset('dist/assets/js/dashboard.js')}}"></script>
    <!-- c3.js Charts Plugin -->
    <link href="{{asset('dist/assets/plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
    <script src="{{asset('dist/assets/plugins/charts-c3/plugin.js')}}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{asset('dist/assets/plugins/maps-google/plugin.css')}}" rel="stylesheet" />
    <script src="{{asset('dist/assets/plugins/maps-google/plugin.js')}}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{asset('dist/assets/plugins/input-mask/plugin.js')}}"></script>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="{{route('home')}}">
                        {{ config('app.name', 'ATL') }}
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">

                        {{--<div class="dropdown d-none d-md-flex">--}}
                            {{--<a class="nav-link icon" data-toggle="dropdown">--}}
                                {{--<i class="fe fe-bell"></i>--}}
                                {{--<span class="nav-unread"></span>--}}
                            {{--</a>--}}
                            {{--<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">--}}
                                {{--<a href="#" class="dropdown-item d-flex">--}}
                                    {{--<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>--}}
                                    {{--<div>--}}
                                        {{--<strong>Nathan</strong> pushed new commit: Fix page load performance issue.--}}
                                        {{--<div class="small text-muted">10 minutes ago</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="dropdown-item d-flex">--}}
                                    {{--<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>--}}
                                    {{--<div>--}}
                                        {{--<strong>Alice</strong> started new task: Tabler UI design.--}}
                                        {{--<div class="small text-muted">1 hour ago</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<a href="#" class="dropdown-item d-flex">--}}
                                    {{--<span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>--}}
                                    {{--<div>--}}
                                        {{--<strong>Rose</strong> deployed new version of NodeJS REST Api V3--}}
                                        {{--<div class="small text-muted">2 hours ago</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-divider"></div>--}}
                                {{--<a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                                <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ Auth::user()->name }}</span>
                      <small class="text-muted d-block mt-1">Administrator</small>
                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-settings"></i> Settings
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="mailto:hugowangchn@gmail.com">
                                    <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="dropdown-icon fe fe-log-out"></i>{{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 ml-auto">
                        {{--<form class="input-icon my-3 my-lg-0">--}}
                            {{--<input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">--}}
                            {{--<div class="input-icon-addon">--}}
                                {{--<i class="fe fe-search"></i>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    </div>
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link"><i class="fe fe-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link text-capitalize" data-toggle="dropdown"><i class="fe fe-box"></i> Vehicle Management</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{route('car_list')}}" class="dropdown-item text-capitalize">Vehicle List</a>
                                    <a href="{{route('car_new')}}" class="dropdown-item text-capitalize">Create Vehicle</a>
                                    <a href="{{route('batch_edit')}}" class="dropdown-item text-capitalize">Vehicle/Batch Edit</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link text-capitalize" data-toggle="dropdown"><i class="fe fe-box"></i> User</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{route('user_list')}}" class="dropdown-item text-capitalize">List Users</a>
                                    <a href="{{route('register')}}" class="dropdown-item text-capitalize">Add New User</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link text-capitalize" data-toggle="dropdown"><i class="fe fe-box"></i> Driver</a>
                                <div class="dropdown-menu dropdown-menu-arrow">
                                    <a href="{{route('driver_list')}}" class="dropdown-item text-capitalize">List Drivers</a>
                                    <a href="{{route('driver_new')}}" class="dropdown-item text-capitalize">Add New Driver</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <!-- display company filter only for the admin user -->
                                @if (\Illuminate\Support\Facades\Auth::user()->company == "")
                                    @component('components.company_filter')
                                    @endcomponent
                                @endif
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            @yield('page')
        </div>
    </div>
    <script src="{{asset('dist/assets/js/vendors/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/system.js')}}"></script>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">

                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © {{\Illuminate\Support\Carbon::today()->year}} <a href="#">{{config('app.name')}}</a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
