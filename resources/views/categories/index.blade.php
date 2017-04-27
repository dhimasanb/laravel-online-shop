@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>Category</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <td>Title</td>
              <td>Parent</td>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
              <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->parent ? $category->parent->title : '' }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $categories->links() }}
      </div>
    </div>
</div>
@endsection
