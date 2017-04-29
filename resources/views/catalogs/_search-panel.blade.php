<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Cari produk</h3>
  </div>
  <div class="panel-body">
    {!! Form::open(['url' => 'catalogs', 'method'=>'get']) !!}
        <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
          {!! Form::label('q', 'Apa yang kamu cari?') !!}
          {!! Form::text('q', $q, ['class'=>'form-control']) !!}
          {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
        </div>

        {!! Form::hidden('cat', $cat) !!}

      {!! Form::submit('Cari', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>
