@extends('layout.client')
@section('title')
  Home - {{config('app.name')}}
@endsection
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
    {{-- Popular Products --}}
    @if($popularProducts->isNotEmpty())
      <div class="product-set">
        <h3>Popular Products <a href="{{url('products/type/Popular')}}">See All</a></h3>
        <div class="row">
          @foreach ($popularProducts as $popularProduct)
            <div class="col-md-4">
              <div class="card">
                <a href="{{url('products/product/' . $popularProduct->slug)}}">
                  <div class="product-img" style="background-image: url({{asset('storage/product_images/' . $popularProduct->images)}})"></div>
                </a>
                <div class="card-body">
                  <a class="title" href="{{url('products/product/' . $popularProduct->slug)}}">
                    <h5 class="card-title">{{$popularProduct->name}} <small>{{$popularProduct->price}}</small></h5>
                  </a>
                  <p class="card-text">{{ substr($popularProduct->details , 0 , 100) }}</p>
                  <div class="info">
                    <a  class="cat" href="{{url('products/category/' . $popularProduct->category )}}">
                      <h6>{{$popularProduct->category}}</h6>
                    </a>
                    <a href="#" class="btn btn-primary add-to-cart" data-id="{{$popularProduct->id}}">Add to Cart</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif


    {{-- New Products --}}
    @if($newProducts->isNotEmpty())
      <div class="product-set">
        <h3>New Products <a href="{{url('products/type/New')}}">See All</a></h3>
        <div class="row">
          @foreach ($newProducts as $newProduct)
            <div class="col-md-4">
              <div class="card">
                <a href="{{url('products/product/' . $newProduct->slug)}}">
                  <div class="product-img" style="background-image: url({{asset('storage/product_images/' . $newProduct->images)}})"></div>
                </a>
                <div class="card-body">
                  <a class="title" href="{{url('products/product/' . $newProduct->slug)}}">
                    <h5 class="card-title">{{$newProduct->name}} <small>{{$newProduct->price}}</small></h5>
                  </a>
                  <p class="card-text">{{ substr($newProduct->details , 0 , 100) }}</p>
                  <div class="info">
                    <a  class="cat" href="{{url('products/category/' . $newProduct->category )}}">
                      <h6>{{$newProduct->category}}</h6>
                    </a>
                    <a href="#" class="btn btn-primary add-to-cart" data-id="{{$newProduct->id}}">Add to Cart</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif



  </div>
@endsection
