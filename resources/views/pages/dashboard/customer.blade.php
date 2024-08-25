@extends('pages.layouts.master')

@section('content')
    @include('components.customer.list')
    @include('components.customer.delete')
    @include('components.customer.create')
    @include('components.customer.update')
@endsection
