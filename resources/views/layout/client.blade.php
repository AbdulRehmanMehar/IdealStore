<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <link rel="icon" href="{{asset('img/logo.png')}}">
  <title>@yield('title')</title>
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
            @foreach ($categories as $category)
              <a class="cat-main" href="{{url('products/category/' . $category->name)}}"> {{$category->name}}</a>
            @endforeach
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a href="{{ url('contact') }}" class="nav-link">Contact Us</a>
      </li>
      <li class="nav-item searchBox">
        <form id="search-form" action="{{url('products/search')}}" method="post">
          @csrf
          <input type="search" class="search-input" name="searchInput" id="searchInput" placeholder="Search......">
          <button type="submit" class="search-button" name="searchButton"><i class="fa fa-search"></i></button>
        </form>
        {{-- <div class="search-results" style="display:none;">
          @foreach ($products as $product)
            <a href="{{url('products/product/'. $product->slug)}}">{{$product->name}}</a>
          @endforeach
        </div> --}}
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="{{ url('products/show-cart') }}" class="nav-link">
          <i class="fas fa-shopping-basket"></i> Cart  &nbsp; &nbsp;<span class="badge cartQtty">{{Session::has('cart') ? Session::get('cart')->totalQtty : "0"}}</span>
        </a>
      </li>
      @guest
        <li class="nav-item">
          <a href="{{ url('login') }}" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
        </li>
        <li class="nav-item">
          <a href="{{ url('register') }}" class="nav-link"><i class="fas fa-user-plus"></i> Sign Up</a>
        </li>
      @else
        <li class="nav-item dropdown">

          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="{{ url('home') }}" class="dropdown-item">Dashboard</a>
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


<form id="add-to-cart" action="{{url('products/add-to-cart')}}" method="post" style="display:none;">
  @csrf
  <input type="hidden" name="p_id" id="p_id">
  <input type="submit" value="Add">
</form>

<footer class="footer text-center">
  <p>&copy; {{date('Y')}} {{config('app.name')}}.All rights reserved!</p>
</footer>

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


@yield('scripts')


<script>
// Clear Console

console.API;
if (typeof console._commandLineAPI !== 'undefined') {
    console.API = console._commandLineAPI; //chrome
} else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
    console.API = console._inspectorCommandLineAPI; //Safari
} else if (typeof console.clear !== 'undefined') {
    console.API = console;
}
console.API.clear();

</script>

</body>
</html>
