@extends('layout.client')

@section('title')
  Register - {{config('app.name')}}
@endsection

@section('content')
  <div class="custom-form-wrapper mt-6">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="links">
                <span style="text-align:left">{{ __('Register') }}</span>
                <div  style="float: right">
                  <a href="{{ route('login') }}">Login</a> | Continue With... &nbsp;
                  <a href="login/google" class="btn btn-danger"><i class="fab fa-google"></i></a>&nbsp;
                  <a href="login/facebook" class="btn btn-primary"><i class="fab fa-facebook-f"></i></a>&nbsp;
                  <a href="login/twitter" class="btn btn-info"><i class="fab fa-twitter"></i></a>&nbsp;
                </div>
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="{{__('Someone')}}">
                    @if ($errors->has('name'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{__('someone@example.com')}}">
                    @if ($errors->has('email'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                  <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="{{__('***********************')}}">
                    @if ($errors->has('password'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                  <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{__('***********************')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Residential Address') }}</label>
                  <div class="col-md-6">
                    <textarea name="address" class="form-control" style="resize: none;" id="address" rows="6" required placeholder="{{__('Model Town Lahore')}}" min="150"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                  <div class="col-md-6">
                    <input id="phone" type="number" class="form-control" name="phone" required placeholder="{{__('03001234567')}}" min="12">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary form-control">
                      {{ __('Register') }}
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
