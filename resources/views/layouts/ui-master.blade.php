
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">

  <title>Pet In One</title>

</head>
<body >

<div id="app">
    <div class="container main-nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
        <a class="navbar-brand" href="/">Pet In One</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item ">

            <a href="/" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
        </li>
        <li class="nav-item">
            <a href="/store" class="nav-link">Store</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/blog">Blogs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/contact">Contact</a>
        </li>
        <!-- SEARCH FORM -->
            {{-- <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </form> --}}
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                 <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link"> Dashboard</a>
                 </li>
                @else
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                </li>

                    @if (Route::has('register'))
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                    @endif
                @endauth
            </div>
            @endif
        </ul>
    </div>
    </nav>
</div>



<div class="content">
    @yield('content')
</div>


</div>

<script src="/js/app.js"></script>
</body>
</html>
