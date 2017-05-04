@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Edit {{ $order->title }}</h3>
        {!! Form::model($order, ['route' => ['orders.update', $order], 'method'=>'patch', 'class'=>'form-horizontal'])!!}
          @include('orders._form', ['model' => $order])
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection
