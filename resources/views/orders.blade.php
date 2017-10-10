@extends('layouts.app')
@section('title','Orders')
@section('contents')
    {!! $html->table(['class' => 'table table-bordered'], true) !!}
@endsection
@push('scripts')
    {!! $html->scripts() !!}    
@endpush