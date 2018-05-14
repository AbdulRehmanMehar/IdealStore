@extends('layout.client')

@section('title')
  Shopping Cart - {{config('app.name')}}
@endsection

@section('content')

  <div class="container mt-6 mb-5">
    @if (Session::has('cart') && Session::get('cart')->totalQtty != 0)
      <div class="mb-3">
        <h3 style="float:left">Your Shopping Cart </h3>
        <form style="float: right; display:none;" id="updateQttyForm" action="{{url('products/update-cart')}}" method="post">
          @csrf
          <div class="form-row align-items-center">
            <div class="col-auto">
              <input type="text" class="form-control form-control-sm" disabled id="item_name" title="Selected Product Name">
            </div>
            <div class="col-auto">
              <input type="number" class="form-control form-control-sm" name="item_qtty" id="item_qtty" title="Change Quantity" min="0">
            </div>
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="item_old_qtty" id="item_old_qtty">
            <div class="col-auto">
              <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </div>
          </div>
        </form>
        <form id="removeItemForm" style="display:none;" action="{{url('products/remove-from-cart')}}" method="post">
          @csrf
          <input type="hidden" name="removeItem_id" id="removeItemID">
          <input type="hidden" name="removeItem_qtty" id="removeItemQTTY">
        </form>
      </div>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col" style="width: 65%;">Product</th>
              <th scope="col">Quantity</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody class="cart-table">
            @foreach ($cartItems as $cartItem)
              <tr>
                <td><a href="{{url('products/product/'.$cartItem['item']['slug'])}}">{{$cartItem['item']['name']}}</a></td>
                <td>{{$cartItem['qtty']}}</td>
                <td>{{$cartItem['price']}}</td>
                <td class="cart-actions">
                  <b class="editQtty" title="Edit Quantity" data-id="{{$cartItem['item']['id']}}" data-name="{{$cartItem['item']['name']}}" data-qtty="{{$cartItem['qtty']}}">
                    <i class="fa fa-pencil-alt"></i>
                  </b> &nbsp; &nbsp;
                  <b class="remove" title="Remove Product" data-id="{{$cartItem['item']['id']}}" data-qtty="{{$cartItem['qtty']}}">
                    <i class="fa fa-trash"></i>
                  </b> &nbsp; &nbsp;
                </td>
              </tr>
            @endforeach
            <tr>
              <td></td>
              <th>Total:</th>
              <td>{{$totalPrice}}</td>
              <td><a href="{{url('products/show-cart/place-order')}}" class="btn btn-success btn-sm">Place Order</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    @else
      <div class="container err-404">
        <h4>Ooops! Your cart is empty</h4>
      </div>
    @endif
  </div>
@endsection

@section('scripts')
  <script>
    $('.cart-actions .remove').each((i,element) => {
      $(element).click(() => {
        $('#removeItemForm #removeItemID').val( $(element).attr('data-id') );
        $('#removeItemForm #removeItemQTTY').val( $(element).attr('data-qtty') );
        $('#removeItemForm').submit();
      });
    });
    $('.cart-actions .editQtty').each((i,element) => {
      $(element).click(() => {
        $('#updateQttyForm').css('display','block');
        $('#updateQttyForm #item_name').val( $(element).attr('data-name') );
        $('#updateQttyForm #item_qtty').val( $(element).attr('data-qtty') );
        $('#updateQttyForm #item_old_qtty').val( $(element).attr('data-qtty') );
        $('#updateQttyForm #item_id').val( $(element).attr('data-id') );
      });
    });
  </script>
@endsection
