@extends('layouts.app')

@section('content')
<div class="container">
  @include('checkout._step')
  <div class="row">
    <div class="col-xs-8">
      <div class="panel panel-default">
          <div class="panel-heading">Login atau Checkout tanpa mendaftar</div>
          <div class="panel-body">
              @include('checkout._login-form')
          </div>
      </div>
    </div>
    <div class="col-xs-4">
    </div>
  </div>
</div>
@endsection
