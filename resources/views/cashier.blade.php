@extends('layouts.app')
@section('metas')
	<meta name="csrf_token" content="{!! csrf_token() !!}">
	
	<!--meta http-equiv="refresh" content="3"-->
@endsection
@section('title','Cashier')

@section('contents')
    {!! $html->table(['class' => 'table table-bordered'], true) !!}
@endsection
@push('scripts')
    {!! $html->scripts() !!}    
    <!--script src="{{asset('js/socket-io.js') }}"></script-->
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{asset('js/app.js') }}"></script>
@endpush