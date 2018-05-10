@extends('layout.admin')
@section('content')
  <div class="container mt-5 mb-1">
    <form method="post" action="savecredentials">
      @csrf
      <h5 class="pt-2 pb-2 text-danger">Basic App Settings</h5>
      <div class="form-row">

        <div class="form-group col-md-6">
          <label for="APP_NAME">App Name</label>
          <input type="text" class="form-control form-control-sm" name="APP_NAME" value="{{$APP_NAME}}">
        </div>

        <div class="form-group col-md-6">
          <label for="APP_DESC">App Description</label>
          <input type="text" class="form-control form-control-sm" name="APP_DESC" value="{{$APP_DESC}}">
        </div>

      </div>
      <h5 class="pt-2 pb-2 text-danger">Database Credentials</h5>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="DB_DATABASE">Database</label>
          <input type="text" class="form-control form-control-sm" name="DB_DATABASE" value="{{$DB_DATABASE}}">
        </div>
        <div class="form-group col-md-4">
          <label for="DB_USERNAME">Database Username</label>
          <input type="text" class="form-control form-control-sm" name="DB_USERNAME" value="{{$DB_USERNAME}}">
        </div>
        <div class="form-group col-md-4 form-group-pwd">
          <label for="DB_PASSWORD">Database Password</label>
          <input type="text" class="form-control form-control-sm" name="DB_PASSWORD" value="{{$DB_PASSWORD}}">
        </div>
      </div>
      <h5 class="pt-2 pb-2 text-danger">Mail Credentials</h5>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="MAIL_HOST">Mail Host</label>
          <input type="text" class="form-control form-control-sm" name="MAIL_HOST" value="{{$MAIL_HOST}}">
        </div>
        <div class="form-group col-md-4">
          <label for="MAIL_USERNAME">Mail Username</label>
          <input type="email" class="form-control form-control-sm" name="MAIL_USERNAME" value="{{$MAIL_USERNAME}}">
        </div>
        <div class="form-group col-md-4">
          <label for="MAIL_PASSWORD">Mail Password</label>
          <input type="text" class="form-control form-control-sm" name="MAIL_PASSWORD" value="{{$MAIL_PASSWORD}}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="MAIL_FROM_NAME">Mail From Name</label>
          <input type="text" class="form-control form-control-sm" name="MAIL_FROM_NAME" value="{{$MAIL_FROM_NAME}}">
        </div>
        <div class="form-group col-md-6">
          <label for="MAIL_FROM_ADDRESS">Mail From Address</label>
          <input type="email" class="form-control form-control-sm" name="MAIL_FROM_ADDRESS" value="{{$MAIL_FROM_ADDRESS}}">
        </div>
      </div>

      <h5 class="pt-2 pb-2 text-danger">Social Credentials</h5>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="GOOGLE_CID">Google Client ID</label>
          <input type="text" class="form-control form-control-sm" name="GOOGLE_CID" value="{{$GOOGLE_CID}}">
        </div>
        <div class="form-group col-md-6">
          <label for="GOOGLE_CSECRET">Google Client Secret</label>
          <input type="text" class="form-control form-control-sm" name="GOOGLE_CSECRET" value="{{$GOOGLE_CSECRET}}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="FB_CID">Facebook Client ID</label>
          <input type="text" class="form-control form-control-sm" name="FB_CID" value="{{$FB_CID}}">
        </div>
        <div class="form-group col-md-6">
          <label for="FB_CSECRET">Facebook Client Secret</label>
          <input type="text" class="form-control form-control-sm" name="FB_CSECRET" value="{{$FB_CSECRET}}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="TWITTER_CID">Twitter Client ID</label>
          <input type="text" class="form-control form-control-sm" name="TWITTER_CID" value="{{$TWITTER_CID}}">
        </div>
        <div class="form-group col-md-6">
          <label for="TWITTER_CSECRET">Twitter Client Secret</label>
          <input type="text" class="form-control form-control-sm" name="TWITTER_CSECRET" value="{{$TWITTER_CSECRET}}">
        </div>
      </div>
      <button type="submit" class="btn btn-outline-primary form-control btn-sm">Save</button>
    </form>
  </div>
@endsection
