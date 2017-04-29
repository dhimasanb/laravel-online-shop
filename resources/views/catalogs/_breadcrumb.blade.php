<ol class="breadcrumb">
  @if(!is_null($current_category))
    <li>Kategori: <a href="{{ url('/catalogs?cat=' . $current_category->id) }}">
      {{ $current_category->title }}</a></li>
  @else
    <li>Kategori: Semua Produk</a></li>
  @endif
</ol>
