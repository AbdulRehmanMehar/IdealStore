@extends('layout.client')

@section('title')
  {{$requestedProduct->name}} - {{config('app.name')}}
@endsection

@section('content')
  {{-- Single Product Display --}}
    @if($requestedProduct)
      <div class="container mt-6 mb-4 requested-product">
        <div class="row">
          <div class="col-md-5">
            <div class="requested-product-image" style="min-height: 280px; max-height: 500px; background: url({{asset('storage/product_images/' . $requestedProduct->images)}}) no-repeat;"></div>
          </div>
          <div class="col-md-7 requested-product-info">
            <h1>{{$requestedProduct->name}} <small>{{$requestedProduct->price}}</small> </h1>
            <p>{{$requestedProduct->details}}</p>
            <h4>
              <a class="cat" href="{{url('products/category/' . $requestedProduct->category )}}">{{$requestedProduct->category}}</a>
              <span>
                <a href="#" class="btn btn-primary add-to-cart" data-id="{{$requestedProduct->id}}">Add to Cart</a>
              </span>
            </h4>
          </div>
        </div>
      </div>
    @endif

    {{-- Products in same category --}}

    @if($intersetedProducts->isNotEmpty())
      <div class="container mt-4 mb-4 product-set" style="margin: 0 auto;">
        <h3>You might also like <a href="{{url('products/category/' . $requestedProduct->category )}}">See More</a></h3>
        <div class="row">
          @foreach ($intersetedProducts as $intersetedProduct)
            <div class="col-md-4">
              <div class="card">
                <a href="{{url('products/product/' . $intersetedProduct->slug)}}">
                  <div class="product-img" style="background-image: url({{asset('storage/product_images/' . $intersetedProduct->images)}})"></div>
                </a>
                <div class="card-body">
                  <a class="title" href="{{url('products/product/' . $intersetedProduct->slug)}}">
                    <h5 class="card-title">{{$intersetedProduct->name}} <small>{{$intersetedProduct->price}}</small></h5>
                  </a>
                  <p class="card-text">{{ substr($intersetedProduct->details , 0 , 100) }}</p>
                  <div class="info">
                    <a  class="cat" href="{{url('products/category/' . $intersetedProduct->category )}}">
                      <h6>{{$intersetedProduct->category}}</h6>
                    </a>
                    <a href="#" class="btn btn-primary add-to-cart" data-id="{{$intersetedProduct->id}}">Add to Cart</a>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

@endsection
