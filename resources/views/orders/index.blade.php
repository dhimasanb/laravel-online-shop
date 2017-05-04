@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover">
          <thead>
            <tr>
              <td>Order #</td>
              <td>Customer</td>
              <td>Status</td>
              <td>Pembayaran</td>
              <td>Update terakhir</td>
            </tr>
          </thead>
          <tbody>
            @forelse($orders as $order)
            <tr>
              <td>{{ $order->padded_id }}</td>
              <td>{{ $order->user->name }}</td>
              <td>{{ $order->human_status }}</td>
              <td>
                Total: <strong>{{ number_format($order->total_payment) }} </strong><br>
                Transfer ke : {{ config('bank-accounts')[$order->bank]['bank'] }} <br>
                Dari : {{ $order->sender }}
              </td>
              <td>{{ $order->updated_at }}</td>
            </tr>
            @empty
              <tr>
                <td colspan="4">Tidak ada order yang ditemukan</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        {!! $orders->links() !!}
      </div>
    </div>
  </div>
@endsection
