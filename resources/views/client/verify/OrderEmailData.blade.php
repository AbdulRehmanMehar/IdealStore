<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Order is Placed</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="mail">
      <div class="header">
        <a href="{{url('/')}}">{{config('app.name')}}</a>
      </div>
      <div class="body">
        <h4>Hello Admin!</h4>
        <p>This email is to inform you that an order is placed on your website.The details are given:</p>
        <p><b>Buyer Name</b>: {{Auth::user()->name}}</p>
        <p><b>Buyer Email</b>: {{Auth::user()->email}}</p>
        <p><b>Buyer Address</b>: {{Auth::user()->address}}</p>
        <p><b>Buyer Phone</b>: {{Auth::user()->phone}}</p>

        @foreach ($orders as $order)
          <div id="accordion">
            <div class="card">
              <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapse{{$order->id}}">{{unserialize($order->cart)->totalQtty}} Items</a>
              </div>
              <div id="collapse{{$order->id}}" class="collapse show" data-parent="#accordion">
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
  </body>
</html>
