@extends('layout.client')

@section('title')
  Contact - {{config('app.name')}}
@endsection

@section('content')
  <div class="container mt-6 mb-3">
    <div class="row">
      <div class="col-md-6 mt-6">
        <div class="jumbotron" style="background: url({{asset('img/details.jpg')}}) no-repeat center; height: 250px; margin: 0 auto; box-shadow: 2px 2px 10px 2px rgba(0,0,0,.2) "></div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Drop Us a Message!</div>
          <div class="card-body">

            <form action="{{url('drop-message')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Name" required>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control form-control-sm" id="message" name="message" rows="6" required min="50" placeholder="Message" style="resize: none;"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-sm form-control">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
