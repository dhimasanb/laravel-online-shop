<div class="form-group">
  <div class="row">
    <div class="col-md-4 text-right">
      <label>Order #</label>
    </div>
    <div class="col-md-6">
      {{ $order->padded_id }}
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-md-4 text-right">
      <label>Customer</label>
    </div>
    <div class="col-md-6">
      {{ $order->user->name }}
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-md-4 text-right">
      <label>Alamat Pengiriman</label>
    </div>
    <div class="col-md-6">
      <address>
       <strong>{{ $order->address->name }}</strong> <br>
       {{ $order->address->detail }} <br>
       {{ $order->address->regency->name }}, {{ $order->address->regency->province->name }} <br>
       <abbr title="Phone">P:</abbr>  +62 {{ $order->address->phone }}
      </address>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="row">
    <div class="col-md-4 text-right">
      <label>Detail</label>
    </div>
    <div class="col-md-6">
      @include('orders._details', compact('order'))
    </div>
  </div>
</div>

<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <div class="row">
      <div class="col-md-4 text-right">
        <label class="control-label">Status</label>
      </div>
      <div class="col-md-6">
          {!! Form::select('status', App\Order::statusList(), null, ['class'=>'form-control']) !!}
          {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
      </div>
    </div>
</div>

{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
