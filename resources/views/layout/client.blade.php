<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="icon" href="{{asset('img/logo.png')}}">
  <title>{{config('app.name')}}</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <a class="navbar-brand" href="{{url('/')}}"> <img src="{{asset('img/logo.png')}}" alt="{{config('app.name')}}" width="65"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarMenu">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item categories">
        <span class="nav-link"><i class="fas fa-th"></i> Products</span>
        <div class="cats-wrapper">
          <div class="triangle"></div>
          <div class="cats">
            <a class="cat-main" href="#"><i class="fas fa-code icn"></i>Development</a>
            <a class="cat-main" href="#"><i class="fas fa-briefcase icn"></i>Business</a>
            <a class="cat-main" href="#"><i class="fas fa-desktop icn"></i>IT & Softwares</a>
            <a class="cat-main" href="#"><i class="fas fa-building icn"></i>Office Productivity</a>
            <a class="cat-main" href="#"><i class="fas fa-book icn"></i>Personal Development</a>
            <a class="cat-main" href="#"><i class="fas fa-pencil-alt icn"></i>Design</a>
            <a class="cat-main" href="#"><i class="fas fa-bullseye icn"></i>Marketing</a>
            <a class="cat-main" href="#"><i class="fab fa-accessible-icon icn"></i>Life Style</a>
            <a class="cat-main" href="#"><i class="fas fa-camera icn"></i>Photography</a>
            <a class="cat-main" href="#"><i class="fas fa-heartbeat icn"></i>Health &amp; Fitness</a>
            <a class="cat-main" href="#"><i class="fas fa-graduation-cap icn"></i>Teacher Training</a>
            <a class="cat-main" href="#"><i class="fas fa-music icn"></i>Music</a>
            <a class="cat-main" href="#"><i class="far fa-gem icn"></i>Academics</a>
            <a class="cat-main" href="#"><i class="fas fa-language icn"></i>Language</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a href="about" class="nav-link">About Us</a>
      </li>
      <li class="nav-item">
        <a href="contact" class="nav-link">Contact Us</a>
      </li>
      <li class="nav-item searchBox">
        <form action="#" method="get">
          <input type="search" class="search-input" name="searchInput" placeholder="Search......">
          <button type="button" class="search-button" name="searchButton"><i class="fa fa-search"></i></button>
        </form>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="cart" class="nav-link"><i class="fas fa-shopping-basket"></i> Cart</a>
      </li>
      @guest
        <li class="nav-item">
          <a href="login" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
        <li class="nav-item">
          <a href="register" class="nav-link"><i class="fas fa-user-plus"></i> Sign Up</a>
        </li>
      @else
        <li class="nav-item dropdown">

          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="home" class="dropdown-item">Dashboard</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      @endguest
    </ul>
  </div>
</nav>
@yield('content')

<div class="flash" id="flash-message"></div>

<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
<script src="{{asset('js/app.js')}}" charset="utf-8"></script>

@if(session('message'))
<script>
  let flash = document.getElementById('flash-message');
  let data = '{{session('message')}}';
  flash.style.display = 'block';
  flash.innerHTML = data;
  setTimeout(() => {
    flash.style.display = 'none';
    flash.innerHTML = '';
  }, 5000);
</script>
@endif


</body>
</html>
