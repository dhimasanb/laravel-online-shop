{!! Form::open(['url' => '/checkout/address', 'method'=>'post', 'class' => 'form-horizontal']) !!}

    @include('checkout._address-field')

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {!! Form::button('Lanjut <i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
        </div>
    </div>

{!! Form::close() !!}
