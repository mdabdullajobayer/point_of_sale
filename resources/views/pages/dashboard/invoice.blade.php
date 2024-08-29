@extends('pages.layouts.master')
@section('content')
    @include('components.invoice.list')
    @include('components.invoice.delete')
    @include('components.invoice.view-invoice')
@endsection
