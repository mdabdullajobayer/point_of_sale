@extends('pages.layouts.master')

@section('content')
    @include('components.products.list')
    @include('components.products.delete')
    @include('components.products.create')
    @include('components.products.update')
@endsection
