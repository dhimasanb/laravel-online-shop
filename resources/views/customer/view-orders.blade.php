@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'home/orders', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
              {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'Order ID']) !!}
              {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {!! $errors->has('status') ? 'has-error' : '' !!}">
              {!! Form::select('status', [''=>'Semua status']+App\Order::statusList(), isset($status) ? $status : null, ['class'=>'form-control']) !!}
              {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
            </div>

          {!! Form::submit('Cari', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
        <table class="table">
          <thead>
            <tr>
              <td>Order #</td>
              <td>Tanggal Order</td>
              <td>Status</td>
              <td>Pembayaran</td>
              <td>Detail</td>
            </tr>
          </thead>
          <tbody>
            @forelse($orders as $order)
            <tr>
              <td>{{ $order->padded_id }}</td>
              <td>{{ $order->created_at }}</td>
              <td>{{ $order->human_status }}</td>
              <td>
                Total: <strong>{{ number_format($order->total_payment) }} </strong><br>
                Transfer ke : {{ config('bank-accounts')[$order->bank]['bank'] }} a.n {{ config('bank-accounts')[$order->bank]['name'] }} {{ config('bank-accounts')[$order->bank]['number'] }}<br>
                Dari : {{ $order->sender }}
              </td>
              <td>
                @include('orders._details', compact('order'))
              </td>
            </tr>
            @empty
              <tr>
                <td colspan="4">Tidak ada order yang ditemukan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {!! $orders->appends(compact('q', 'status'))->links() !!}
      </div>
    </div>
  </div>
@endsection
