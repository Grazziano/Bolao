@if (!$search && $list)
  {{-- Paginação --}}
  <div class="">
    {{$list->links()}}
  </div>
@endif
