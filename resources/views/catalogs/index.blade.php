@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        @include('catalogs._search-panel', [
          'q' => isset($q) ? $q : null,
          'cat' => isset($cat) ? $cat : ''
        ])

        @include('catalogs._category-panel')

        @if (isset($category) && $category->hasChild())
          @include('catalogs._sub-category-panel', ['current_category' => $category])
        @endif

        @if (isset($category) && $category->hasParent())
          @include('catalogs._sub-category-panel', [
            'current_category' => $category->parent
          ])
        @endif
      </div>
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            @include('catalogs._breadcrumb', [
              'current_category' => isset($category) ? $category : null
            ])
            @if ($errors->has('quantity'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ $errors->first('quantity') }}
            </div>
            @endif
          </div>
          @forelse ($products as $product)
           <div class="col-md-6">
             @include('catalogs._product-thumbnail', ['product' => $product])
           </div>
         @empty
           <div class="col-md-12 text-center">
             @if (isset($q))
               <h1>:(</h1>
               <p>Produk dengan kata kunci tidak ditemukan.</p>
               @if (isset($category))
                 <p><a href="{{ url('/catalogs?q=' . $q) }}">Cari di semua kategori <i class="fa fa-arrow-right"></i></a></p>
               @endif
             @else
               <h1>:|</h1>
               <p>Belum ada produk untuk kategori ini.</p>
             @endif
             <p><a href="{{ url('/catalogs') }}">Lihat semua produk <i class="fa fa-arrow-right"></i></a></p>
           </div>
         @endforelse

          <div class="pull-right">
            {!! $products->appends(compact('cat', 'q', 'sort', 'order'))->links() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
