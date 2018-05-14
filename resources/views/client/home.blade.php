@extends('layout.client')

@section('title')
  Dashboard - {{config('app.name')}}
@endsection

@section('content')
  <div class="container-fluid mt-6 mb-5">
    <div class="row justify-content-center dashboard">
      <div class="col-md-8 offset-md-1">
        <div class="card">
          <div class="card-header">Dashboard - {{Auth::user()->name}}</div>
          <div class="card-body">
            <div class="item">
              <b>Profile Status:</b>
              <span>{{((Auth::user()->address == null) || (Auth::user()->phone == null)) ?  "Incomplete" : "Complete"}}</span> &nbsp; &nbsp; &nbsp;
              <a id="editProfile" href="#" title="Edit Profile"> <i class='fa fa-pencil-alt'></i> </a>
            </div>
            <div class="item">
              <b>Cart Status:</b>
              <span>{{(Session::has('cart')) ? Session::get('cart')->totalQtty : "0"}}</span> &nbsp; &nbsp; &nbsp;
              <a href="{{url('products/show-cart')}}" title="View Cart"> <i class="fa fa-eye"></i> </a>
            </div>
            <div class="item">
              <b>Order Status:</b>
              <span></span> &nbsp; &nbsp; &nbsp;
              <a href="#" id="showOrders" title="View Orders"> <i class="fa fa-eye"></i> </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 editProfileCard" style="display:none;">
        <div class="card " >
          <div class="card-header">Edit Profile - {{Auth::user()->name}}</div>
          <div class="card-body">
            <form action="{{url('home/update-profile')}}" method="post" title="Change Password? Please click on Forgot password on login page">
              @csrf
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control form-control-sm" name="u_username" value="{{Auth::user()->name}}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control form-control-sm disabled" name="u_email" value="{{Auth::user()->email}}" disabled>
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea class="form-control form-control-sm" rows="6" name="u_address" min="150">{{Auth::user()->address}}</textarea>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="number" class="form-control form-control-sm" name="u_phone" value="{{Auth::user()->phone}}" min="12">
              </div>
              <input type="hidden" name="u_id" value="{{Auth::user()->id}}">
              <button type="submit" class="btn btn-info form-control btn-sm">Update</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-4 showOrdersCard" style="display:none;">
        <div class="card">
          <div class="card-header">My Orders</div>
          <div class="card-body">
            @foreach ($orders as $order)
              <div id="accordion">
                <div class="card">
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapse{{$order->id}}">{{unserialize($order->cart)->totalQtty}} Items</a>
                    <span style="float: right">{{$order->complete_status == "false" ? "Pending" : "Done"}}</span>
                  </div>
                  <div id="collapse{{$order->id}}" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table">
                          <tr>
                            <th style="width: 70%;">Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                          </tr>

                          @foreach (unserialize($order->cart)->items as $item)
                            <tr>
                              <td>{{$item['item']['name']}}</td>
                              <td>{{$item['qtty']}}</td>
                              <td>{{$item['price']}}</td>
                            </tr>
                          @endforeach
                          <tr>
                            <td></td>
                            <td>Total: </td>
                            <td>{{unserialize($order->cart)->totalPrice}}</td>
                          </tr>
                        </table>
                      </div>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>

@endsection

@section('scripts')
  <script>
    $('.card .item #editProfile').click((event) => {
      event.preventDefault();
      $('.dashboard .col-md-8').removeClass('offset-md-1');
      $('.editProfileCard').css('display','block');
      $('.showOrdersCard').css('display','none');
    });
    $('.card .item #showOrders').click((event) => {
      event.preventDefault();
      $('.dashboard .col-md-8').removeClass('offset-md-1');
      $('.editProfileCard').css('display','none');
      $('.showOrdersCard').css('display','block');
    });
  </script>
@endsection
