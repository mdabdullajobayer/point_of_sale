@extends('pages.layouts.master')

@section('content')
    @include('components.category.list')
    @include('components.category.delete')
    @include('components.category.create')
    @include('components.category.update')
@endsection
