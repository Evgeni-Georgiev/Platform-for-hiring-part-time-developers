<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('/app.css') }}" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/083138e535.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="font-size: 20px;">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('developers.show')}}">
            <img src="{{asset('images/logo.png')}}" width="150px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-toggle="collapse"
                data-target="#navbarToggleExternalContent" data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('developers.show')}}"><i
                                class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('hire.create')}}"><i
                                class="fa-solid fa-briefcase"></i> Hire Developer(s)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('developers.create')}}"><i
                                class="fa-solid fa-circle-plus"></i> Create Developer</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div id="navbarDropdown" class="nav-link active dropdown-toggle" type="button"
                             data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Welcome, {{ Auth::user()->name }}
                        </div>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-door-open"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
    </div>
    </div>
</nav><br>
{{--@extends('components.nav')--}}
