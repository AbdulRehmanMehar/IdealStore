@extends('layout.admin')
@section('content')
  <div class="container-fluid mt-5">
    <div class="row">

      <div class="col-md-8">
        <div class="card cat-list">
          <div class="card-header"><i class="fas fa-tags"></i> Categories</div>
          <div class="card-body">
            <div class="item active">
              <b>Category Name</b>
              <span class="edit">
                <b title="Parent">Category Parent</b> &nbsp; &nbsp; &nbsp; &nbsp;
                <b>Actions</b>
              </span>
            </div>
            @foreach ($categories as $category)
              <div class="item">
                <b>{{$category->name}}</b>
                <span class="edit">
                  <b title="Parent">{{$category->parent}}</b> &nbsp; &nbsp; &nbsp; &nbsp;
                  <b class="editor" data-id="{{$category->id}}" data-name="{{$category->name}}" data-parent="{{$category->parent}}"><i class="fa fa-pencil-alt"></i></b> &nbsp;
                  <b class="trash" data-id="{{$category->id}}"><i class="fa fa-trash"></i></b>
                </span>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card mb-1">
          <div class="card-header"><i class="fa fa-plus"></i> Add Category</div>
          <div class="card-body">
            <form action="add-category" method="POST">
              @csrf
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" class="form-control form-control-sm" name="c_name" placeholder="Category Name" required>
              </div>
              <div class="form-group">
                <label>Parent</label>
                <select class="form-control form-control-sm" name="c_parent">
                  <option value="">none</option>
                  @foreach ($categories as $category)
                    <option>{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary btn-sm form-control">Add</button>
            </form>
          </div>
        </div>

        <div class="card update-category" style="display:none;">
          <div class="card-header"><i class="fa fa-pencil-alt"></i> Update Category</div>
          <div class="card-body">
            <form action="update-category" method="POST">
              @csrf
              <div class="form-group">
                <label>Category Name</label>
                <input type="text" class="form-control form-control-sm" id="u_name" name="u_name">
              </div>
              <div class="form-group">
                <label>Parent</label>
                <select class="form-control form-control-sm" id="u_parent" name="u_parent">

                  @foreach ($categories as $category)
                    <option>{{$category->name}}</option>
                  @endforeach
                  <option value="">none</option>
                </select>
              </div>
              <input type="hidden" id="u_id" name="u_id">
              <button type="submit" class="btn btn-primary btn-sm form-control">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <form id="delete-cat" style="display:none;" action="delete-category" method="post">
    @csrf
    <input type="hidden" name="d_id" id="d_id">
  </form>
@endsection


@section('scripts')
  <script>
    // Loading Editor Dynamically
    $('.cat-list .editor').each((i,element) => {
      $(element).click(() => {
        $('.update-category').css('display', 'block');
        $('.update-category #u_name').val( $(element).attr('data-name') );
        $('.update-category #u_id').val( $(element).attr('data-id') );
        $('.update-category #u_parent').val( $(element).attr('data-parent') );
      });
    });
    // Deleting the Category
    $('.cat-list .trash').each((i,element) => {
      $(element).click(() => {
        $('#delete-cat #d_id').val( $(element).attr('data-id') );
        $('#delete-cat').submit();
      });
    });
  </script>
@endsection
