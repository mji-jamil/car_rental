@extends('layout.sidenav-layout')
@section('content')
    @include('components.rental.rental-list')
    @include('components.rental.rental-delete')
    @include('components.rental.rental-create')
    @include('components.rental.rental-update')
@endsection
