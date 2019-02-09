@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('bolao.list', ['page' => $page])</div>

                <div class="card-body">

                    @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
                    @endalert_component

                    @breadcrumb_component(['page'=>$page, 'items'=>$breadcrumb ?? []])
                    @endbreadcrumb_component

                    @search_component(['routeName'=>$routeName, 'search'=>$search])
                    @endsearch_component

                    @table_component(['columnList'=>$columnList, 'list'=>$list])
                    @endtable_component
                    
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
