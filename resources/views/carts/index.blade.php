@extends('layouts.app')

@section('content')
<div class="container">
  @if ($cart->isEmpty())
    <div class="text-center">
      <h1>:|</h1>
      <p>Cart kamu masih kosong.</p>
      <p><a href="{{ url('/catalogs') }}">Lihat semua produk <i class="fa fa-arrow-right"></i></a></p>
    </div>
  @else
    <table class="cart table table-hover table-condensed">
      <thead>
        <tr>
          <th style="width:50%">Produk</th>
          <th style="width:10%">Harga</th>
          <th style="width:8%">Jumlah</th>
          <th style="width:22%" class="text-center">Subtotal</th>
          <th style="width:10%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart->details() as $order)
        <tr>
          <td data-th="Produk">
            <div class="row">
              <div class="col-sm-2 hidden-xs"><img src="{{ $order['detail']['photo_path'] }}" alt="..." class="img-responsive"/></div>
              <div class="col-sm-10">
                <h4 class="nomargin">{{ $order['detail']['name'] }}</h4>
              </div>
            </div>
          </td>
          <td data-th="Harga">Rp{{ number_format($order['detail']['price']) }}</td>
          <td data-th="Jumlah">
            {!! Form::open(['url' => ['cart', $order['id']], 'method'=>'put', 'class' => 'form-inline' ]) !!}
            {!! Form::number('quantity', $order['quantity'], ['class'=>'form-control text-center']) !!}
          </td>
          <td data-th="Subtotal" class="text-center">Rp{{ number_format($order['subtotal'] ) }}</td>
          <td class="actions" data-th="">
            {!! Form::button('<i class="fa fa-refresh"></i>', array('type' => 'submit', 'class' => 'btn btn-info btn-sm')) !!}
            {!! Form::close() !!}

            {!! Form::open(['url' => ['cart', $order['id']], 'method'=>'delete', 'class' => 'form-inline']) !!}
            {!! Form::button('<i class="fa fa-trash-o"></i>', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm js-submit-confirm', 'data-confirm-message' => 'Kamu akan menghapus ' . $order['detail']['name'] . ' dari cart.')) !!}
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="visible-xs">
          <td class="text-center"><strong>Total Rp{{ number_format($cart->totalPrice()) }}</strong></td>
        </tr>
        <tr>
          <td><a href="{{ url('/catalogs') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Belanja lagi</a></td>
          <td colspan="2" class="hidden-xs"></td>
          <td class="hidden-xs text-center"><strong>Total Rp{{ number_format($cart->totalPrice()) }}</strong></td>
          <td><a href="{{ url('/checkout/login') }}" class="btn btn-success btn-block">Pembayaran <i class="fa fa-angle-right"></i></a></td>
        </tr>
      </tfoot>
    </table>
  @endif

</div>
@endsection
