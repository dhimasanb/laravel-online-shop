@extends('layouts.app')

@section('content')
<div class="container">
  @include('checkout._step')
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
          <div class="panel-heading">Permintaan Password</div>
          <div class="panel-body">
              @include('checkout._request-password-form')
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
