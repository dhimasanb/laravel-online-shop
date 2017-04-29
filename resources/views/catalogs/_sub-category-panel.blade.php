<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Subkategori untuk {{ $current_category->title }}</h3>
  </div>
  <div class="list-group">
    @foreach($current_category->childs as $category)
      <a href="{{ url('/catalogs?cat=' . $category->id)}}" class="list-group-item">{{ $category->title }}
      {!! $category->total_products > 0 ? '<span class="badge">' . $category->total_products . '</span>' : '' !!}</a>
    @endforeach
  </div>
</div>
