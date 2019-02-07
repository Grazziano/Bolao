@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('bolao.list', ['page' => $page])</div>

                <div class="card-body">

                    @alert(['msg'=>session('msg'), 'status'=>session('status')])
                    @endalert

                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">@lang('bolao.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('bolao.list', ['page' => $page])</li>
                      </ol>
                    </nav>

                    <form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
                      <div class="form-group mb-2">
                        <a href="#">@lang('bolao.add')</a>
                      </div>
                      <div class="form-group mx-sm-3 mb-2">
                        <input type="search" class="form-control" name="search" placeholder="@lang('bolao.search')" value="{{$search}}">
                      </div>
                      <button type="submit" class="btn btn-primary mb-2">@lang('bolao.search')</button>
                      <a class="btn btn-warning mb-2" href="{{route($routeName.'.index')}}">@lang('bolao.clean')</a>
                    </form>


                    <table class="table">
                      <thead>
                        <tr>
                          @foreach ($columnList as $key => $value)
                            <th scope="col">{{$value}}</th>
                          @endforeach

                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($list as $key => $value)

                          <tr>
                            @foreach ($columnList as $key2 => $value2)
                              @if ($key2 == 'id')
                                <th scope="row"> @php echo $value->{$key2}; @endphp </th>
                              @else
                                <td> @php echo $value->{$key2}; @endphp </td>
                              @endif
                            @endforeach

                          </tr>
                        @endforeach


                      </tbody>
                    </table>
                    @if (!$search && $list)
                      {{-- Paginação --}}
                      <div class="">
                        {{$list->links()}}
                      </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
