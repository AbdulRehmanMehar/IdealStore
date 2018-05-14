@extends('layout.client')

@section('content')

  <div class="container-fluid mt-6 mb-5">
    @if($requestedProducts)
      <div class="product-set mt-2 mb-2">
        <h3><span id="categoryname"></span> Products</h3>
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
                    <a href="#" class="btn btn-primary add-to-cart" data-id="{{$requestedProduct->id}}">Add to Cart</a>
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

@section('scripts')
  <script>
    let title = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
    $('#categoryname').html(title);
    $('title').html(`${title} Products - {{config('app.name')}}`);
  </script>
@endsection
