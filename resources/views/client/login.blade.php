@extends('layout.client')

@section('title')
  Login - {{config('app.name')}}
@endsection

@section('content')

  <div class="custom-form-wrapper">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">

              <div class="links">
                <span style="text-align:left">{{ __('Login') }}</span>
                <div  style="float: right">
                  <a href="{{ route('register') }}">Sign Up</a> | Continue With... &nbsp;
                  <a href="login/google" class="btn btn-danger"><i class="fab fa-google"></i></a>&nbsp;
                  <a href="login/facebook" class="btn btn-primary"><i class="fab fa-facebook-f"></i></a>&nbsp;
                  <a href="login/twitter" class="btn btn-info"><i class="fab fa-twitter"></i></a>&nbsp;
                </div>
              </div>

            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{__('someone@example.com')}}">
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
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required  placeholder="{{__('*******************')}}">
                    @if ($errors->has('password'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-info form-control">
                        {{ __('Login') }}
                    </button>
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
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
