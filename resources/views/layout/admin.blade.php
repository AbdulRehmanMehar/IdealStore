<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">
  <link rel="icon" href="{{asset('img/logo.png')}}">
  <title>Admin Area - {{config('app.name')}}</title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{url('/')}}/admin">Admin Area</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav mr-auto">
        @guest('admin')
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link"><i class="fa fa-home"></i> Go Back</a>
          </li>
        @else
          <li class="nav-item">
            <a href="showcredentials" class="nav-link"><i class="fa fa-key"></i> Credentials</a>
          </li>
          <li class="nav-item">
            <a href="categories" class="nav-link"><i class="fas fa-tags"></i> Categories</a>
          </li>
          <li class="nav-item">
            <a href="products" class="nav-link"><i class="fas fa-th"></i> Products</a>
          </li>
        @endguest
      </ul>
      <ul class="navbar-nav ml-auto">
        @guest('admin')
        @else
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
           </form>
          </li>
        @endguest
      </ul>
    </div>
  </nav>

  @yield('content')

  <div class="flash" id="flash-message"></div>

  <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"></script>
  <script src="{{asset('js/admin.js')}}" charset="utf-8"></script>

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
</body>
</html>
