@extends('layout.client')
@section('content')
  <div class="header" style="background-image: url({{asset('img/bg.jpg')}})">
    {{-- <div class="bg-video">
      <video src="{{asset('vid/bg.mp4')}}" autoplay='true' loop='true'></video>
    </div> --}}
    <div class="content">
      <h1>{{config('app.name')}}</h1>
      <h5>{{config('app.desc')}}</h5>
      {{-- <img src="{{asset('img/logo.png')}}" alt="{{config('app.desc')}}" width="200"><br> --}}
      <div class="links">
          @guest
            <a href="{{ route('register') }}">Sign Up</a> | Login With... &nbsp;
            <a href="login/google" class="btn btn-outline-danger"><i class="fab fa-google fa-lg"></i></a>&nbsp;
            <a href="login/facebook" class="btn btn-outline-primary"><i class="fab fa-facebook-f fa-lg"></i></a>&nbsp;
            <a href="login/twitter" class="btn btn-outline-info"><i class="fab fa-twitter fa-lg"></i></a>&nbsp;
          @else
            <a href="home">Go to Dashboard</a> | <a href="#" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a>
          @endguest
        </h6>
      </div>

    </div>
    <div class="info">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="table">
              <div class="td">
                <i class="fas fa-hands-helping fa-3x"></i>
              </div>
              <div class="td">
                <h4>Why Choose Us?</h4>
                <h6>We've plenty of Products</h6>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="table">
              <div class="td">
                <i class="fas fa-clock fa-3x"></i>
              </div>
              <div class="td">
                <h4>Fastest Delivery</h4>
                <h6>Shipping in 1 day</h6>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="table">
              <div class="td">
                <i class="fa fa-money-bill-alt fa-3x"></i>
              </div>
              <div class="td">
                <h4>Cash on Delivery</h4>
                <h6>Your Money is Safe!</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Header Ends..... --}}
  <div class="container-fluid">
    <div class="product-set">
      <h3>Popular Products <a href="#">See All</a></h3>
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="product-img" style="background-image: url(https://dummyimage.com/600x400/000/fff)"></div>
            <div class="card-body">
              <h5 class="card-title">Trouser Shirt <small>1000</small></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="info">
                <h6>Uncategorized</h6>  <a href="#" class="btn btn-primary">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-4">
          <div class="card">
            <div class="product-img" style="background-image: url(https://dummyimage.com/600x400/000/fff)"></div>
            <div class="card-body">
              <h5 class="card-title">Jeans<small>1000</small></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="info">
                <h6>Uncategorized</h6>  <a href="#" class="btn btn-primary">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="product-img" style="background-image: url(https://dummyimage.com/600x400/000/fff)"></div>
            <div class="card-body">
              <h5 class="card-title">Casual Shirt <small>1000</small></h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="info">
                <h6>Uncategorized</h6>  <a href="#" class="btn btn-primary">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
@endsection
