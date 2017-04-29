@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        @include('catalogs._category-panel')
      </div>
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            @include('catalogs._breadcrumb', [
              'current_category' => isset($category) ? $category : null
            ])
          </div>
          @foreach ($products as $product)
          <div class="col-md-6">
            @include('catalogs._product-thumbnail', ['product' => $product])
          </div>
          @endforeach

          <div class="pull-right">
            {!! $products->appends(compact('cat'))->links() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
