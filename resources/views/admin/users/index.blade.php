@extends('layouts.app')

@section('content')
    @page_component(['col'=>12, 'page'=>$page])

          @alert_component(['msg'=>session('msg'), 'status'=>session('status')])
          @endalert_component

          @breadcrumb_component(['page'=>$page, 'items'=>$breadcrumb ?? []])
          @endbreadcrumb_component

          @search_component(['routeName'=>$routeName, 'search'=>$search])
          @endsearch_component

          @table_component(['columnList'=>$columnList, 'list'=>$list])
          @endtable_component

          @paginate_component(['search'=>$search, 'list'=>$list])
          @endpaginate_component

    @endpage_component
@endsection
