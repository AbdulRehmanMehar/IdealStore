@extends('layout.client')

@section('title')
  Search Results - {{config('app.name')}}
@endsection

@section('content')


  <div class="container-fluid mt-6 mb-5">
    @if($requestedProducts->isNotEmpty())
      <div class="product-set mt-2 mb-2">
        <h3>Search Results </h3>
        <div class="row">
          @foreach ($requestedProducts as $requestedProduct)
            <div class="col-md-4">
              <div class="card mt-3 mb-3">
                <a href="{{url('products/product/' . $requestedProduct->slug)}}">
                  <div class="product-img" style="background-image: url({{asset('storage/product_images/' . $requestedProduct->images)}})"></div>
                </a>
                <div class="card-body">
                  <a class="title" href="{{url('products/product/' . $requestedProduct->slug)}}">
                    <h5 class="card-title">{{$requestedProduct->name}} <small>{{$requestedProduct->price}}</small></h5>
                  </a>
                  <p class="card-text">{{ substr($requestedProduct->details , 0 , 100) }}</p>
                  <div class="info">
                    <a  class="cat" href="{{url('products/category/' . $requestedProduct->category )}}">
                      <h6>{{$requestedProduct->category}}</h6>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @else
      <div class="container err-404">
        <h4>404 - Requested Product was not found!</h4>
        <p>We're sorry we couldn't find the requested product.</p>
      </div>
    @endif
  </div>




@endsection
