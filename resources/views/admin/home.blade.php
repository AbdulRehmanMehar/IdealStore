@extends('layout.admin')
@section('content')
  <div class="container-fluid mt-5 mb-4">
    <div class="row">
      <div class="col-md-6">
        <div class="card"  style="max-height: 87vh; overflow: auto;">
          <div class="card-header">InComplete Orders</div>
          <div class="card-body">
            <div id="InCompleteOrders" class="incomplete-orders">
              @foreach ($orders as $order)
                @if($order->complete_status == 'false')
                  <div class="card">
                    <div class="card-header">
                      <a class="card-link" data-toggle="collapse" href="#collapse{{$order->id}}">
                        Order By : {{$order->buyer_email}} &nbsp;
                      </a>
                      <span style="float: right; cursor: pointer" class="MarkCompleted" data-id="{{$order->id}}">Mark as Completed</span>
                    </div>
                    <div id="collapse{{$order->id}}" class="collapse" data-parent="#InCompleteOrders">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th colspan="3" class="bg-info text-center">Product Details</th>
                            </tr>
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
                              <th>Total: </th>
                              <td>{{unserialize($order->cart)->totalPrice}}</td>
                            </tr>
                            <tr>
                              <th colspan="3" class="bg-info text-center">Shipping Details</th>
                            </tr>
                            <tr>
                              <th>Buyer Name</th>
                              <td colspan="2">{{$order->buyer_name}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Email</th>
                              <td colspan="2">{{$order->buyer_email}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Address</th>
                              <td colspan="2">{{$order->buyer_address}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Phone</th>
                              <td colspan="2">{{$order->buyer_phone}}</td>
                            </tr>
                          </table>
                        </div>
                        </ul>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
      {{-- Completed Orders --}}
      <div class="col-md-6">
        <div class="card"  style="max-height: 87vh; overflow: auto;">
          <div class="card-header">Completed Orders</div>
          <div class="card-body">
            <div id="OrdersCompleted" class="completed-orders">
              @foreach ($orders as $order)
                @if($order->complete_status == 'true')
                  <div class="card">
                    <div class="card-header">
                      <a class="card-link" data-toggle="collapse" href="#show{{$order->id}}">
                        Order By : {{$order->buyer_email}} &nbsp;
                      </a>
                      <span style="float: right; cursor: pointer" class="MarkIncompleted" data-id="{{$order->id}}">Mark as InComplete</span>
                    </div>
                    <div id="show{{$order->id}}" class="collapse" data-parent="#OrdersCompleted">
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <tr>
                              <th colspan="3" class="bg-info text-center">Product Details</th>
                            </tr>
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
                              <th>Total: </th>
                              <td>{{unserialize($order->cart)->totalPrice}}</td>
                            </tr>
                            <tr>
                              <th colspan="3" class="bg-info text-center">Shipping Details</th>
                            </tr>
                            <tr>
                              <th>Buyer Name</th>
                              <td colspan="2">{{$order->buyer_name}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Email</th>
                              <td colspan="2">{{$order->buyer_email}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Address</th>
                              <td colspan="2">{{$order->buyer_address}}</td>
                            </tr>
                            <tr>
                              <th>Buyer Phone</th>
                              <td colspan="2">{{$order->buyer_phone}}</td>
                            </tr>
                          </table>
                        </div>
                        </ul>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<form id="MarkAsCompletedForm" action="{{url('admin/order-completed')}}" method="post" style="display:none">
  @csrf
  <input type="hidden" name="i_order_id" id="i_order_id">
</form>
<form id="MarkAsInCompleteForm" action="{{url('admin/order-incomplete')}}" method="post" style="display:none">
  @csrf
  <input type="hidden" name="c_order_id" id="c_order_id">
</form>
@endsection



@section('scripts')
  <script>
    $('.incomplete-orders .MarkCompleted').each((i,element) => {
      $(element).click(() => {
        $('#MarkAsCompletedForm #i_order_id').val( $(element).attr('data-id') );
        $('#MarkAsCompletedForm').submit();
      });
    });

    $('.completed-orders .MarkIncompleted').each((i,element) => {
      $(element).click(() => {
        $('#MarkAsInCompleteForm #c_order_id').val( $(element).attr('data-id') );
        $('#MarkAsInCompleteForm').submit();
      });
    });
  </script>
@endsection
