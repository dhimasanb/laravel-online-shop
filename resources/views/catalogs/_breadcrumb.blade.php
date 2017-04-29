<ol class="breadcrumb">
  @if(!is_null($current_category))
    <li>Kategori: <a href="{{ url('/catalogs?cat=' . $current_category->id) }}">{{ $current_category->title }}</a></li>
  @else
    <li>Kategori: Semua Produk</a></li>
  @endif
  <span class="pull-right">Urutkan Harga:
  <a href="{{ appendQueryString(['sort'=>'price', 'order'=>'asc']) }}"
    class="btn btn-default btn-xs
    {{ isQueryStringEqual(['sort'=>'price', 'order'=>'asc']) ? 'active' : ''}}"
    >Termurah</a> |
  <a href="{{ appendQueryString(['sort'=>'price', 'order'=>'desc']) }}"
    class="btn btn-default btn-xs
    {{ isQueryStringEqual(['sort'=>'price', 'order'=>'desc']) ? 'active' : ''}}"
    >Termahal</a>
</ol>
