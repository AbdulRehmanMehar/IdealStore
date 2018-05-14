@extends('layout.admin')
@section('content')
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-md-7">
        <div class="card" style="max-height: 90vh; overflow: auto;">
          <div class="card-header"><i class="fas fa-th"></i> Products</div>
          <div class="card-body">
            <div class="table-responsive-md">
              <table class="table table-hover">
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Details</th>
                  <th scope="col">Price</th>
                  <th scope="col">Orders</th>
                  <th scope="col">Category</th>
                  <th scope="col">Image</th>
                  <th scope="col">Action</th>
                </tr>
                <tbody class="product-list">
                  @foreach ($products as $product)
                    <tr id="tr{{$product->id}}">
                      <td>{{$product->name}}</td>
                      <td>{{ substr($product->details, 0 , 20) . ' ...' }}</td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->orders}}</td>
                      <td>{{$product->category}}</td>
                      <td>{{$product->images}}</td>
                      <td class="actions">
                        <b class="editor" style="cursor: pointer;" data-id="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->price}}" data-category="{{$product->category}}" data-image="{{$product->images}}" data-details="{{$product->details}}">
                           <i class="fa fa-pencil-alt"></i>
                        </b> &nbsp;
                        <b class="trash" style="cursor: pointer;" data-id="{{$product->id}}"> <i class="fa fa-trash"></i> </b> &nbsp; &nbsp;
                        <b><a href="{{url('/products/product/' . $product->slug )}}" target="_blank">View</a></b>
                      </td>

                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5">
        {{-- Add Product Form --}}
        <div class="card add-product-form" style="max-height: 90vh; overflow: auto;">
          <div class="card-header"><i class="fa fa-plus"></i> Add Product</div>
          <div class="card-body">
            <form action="add-product" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-row">
                <div class="form-group col">
                  <label>Name || Title</label>
                  <input type="text" class="form-control form-control-sm" name="p_name" placeholder="Product name" required>
                </div>
                <div class="form-group col">
                  <label>Price</label>
                  <input type="number" class="form-control form-control-sm" name="p_price" placeholder="Product price" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <label>Category</label>
                  <select class="form-control form-control-sm" name="p_category" required>
                    @foreach ($categories as $category)
                      <option>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col">
                  <label>Image</label>
                  <button type="button" class="btn btn-light form-control btn-sm" id="p_image_btn">Browse Image</button>
                  <input type="file" name="p_image" id="p_image" style="display:none;" accept="image/*" >
                </div>
              </div>
              <div class="form-group">
                <label>Details</label>
                <textarea name="p_details" class="form-control form-control-sm" rows="13" cols="80" style="resize:none;" minlength="100" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-sm form-control">Add</button>
            </form>
          </div>
        </div>
        {{-- Update Product Form --}}
        <div class="card update-product-form" style="max-height: 90vh; overflow: auto; display:none;">
          <div class="card-header"><i class="fa fa-pencil-alt"></i> Update Product<div style="float: right;"><b id="close-update-form"><i class="fa fa-times"></i></b></div></div>
          <div class="card-body">
            <form action="update-product" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="u_id" id="u_id">
              <div class="form-row">
                <div class="form-group col">
                  <label>Name || Title</label>
                  <input type="text" class="form-control form-control-sm" id="u_name" name="u_name">
                </div>
                <div class="form-group col">
                  <label>Price</label>
                  <input type="number" class="form-control form-control-sm" id="u_price" name="u_price">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col">
                  <label>Category</label>
                  <select class="form-control form-control-sm" id="u_category" name="u_category">
                    @foreach ($categories as $category)
                      <option>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col">
                  <label>Image</label>
                  <button type="button" class="btn btn-light form-control btn-sm" id="u_image_btn">Browse Image</button>
                  <input type="file" name="u_image" id="u_image" style="display:none;" accept="image/*" >
                </div>
              </div>
              <div class="form-group">
                <label>Details</label>
                <textarea id="u_details" name="u_details" class="form-control form-control-sm" rows="13" cols="80" style="resize:none;" minlength="100" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-sm form-control">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form id="delete-product" action="delete-product" method="post" style="display:none;">
    @csrf
    <input type="hidden" id="d_id" name="d_id">
  </form>
@endsection

@section('scripts')
  <script>
  $('#p_image_btn').click(() => $('#p_image').click());
  $('#u_image_btn').click(() => $('#u_image').click());

    // Display and Hide Update Form
    $('#close-update-form').click(() => {
      $('.add-product-form').css('display', 'block');
      $('.update-product-form').css('display', 'none');
    });

    // Loading Data to Update
    $('.product-list .editor').each((i,element) => {
      $(element).click(() => {
        $('.add-product-form').css('display', 'none');
        $('.update-product-form').css('display', 'block');

        $('.update-product-form #u_id').val( $(element).attr('data-id') );
        $('.update-product-form #u_name').val( $(element).attr('data-name') );
        $('.update-product-form #u_price').val( $(element).attr('data-price') );
        $('.update-product-form #u_category').val( $(element).attr('data-category') );
        // $('.update-product-form #u_image').val( $(element).attr('data-image') );
        $('.update-product-form .background-image').css('background-image', `url( )`);
        $('.update-product-form #u_details').val( $(element).attr('data-details') );

      });
    });

    // Dynamic Url
    $('.product-list .trash').each((i,element) => {
      $(element).click(() => {
        $('#delete-product #d_id').val($(element).attr('data-id'));
        $('#delete-product').submit();
      });
    });

  </script>
@endsection
