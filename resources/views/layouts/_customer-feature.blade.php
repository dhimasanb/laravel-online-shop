@can('customer-access')
  @include($partial_view, isset($data) ? $data : [])
@else
  @if (auth()->guest())
    @include($partial_view, isset($data) ? $data : [])
  @endif
@endcan
