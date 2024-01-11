@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div style = "background-color:white">
        {{-- <button onclick="window.location='{{ route('addBook')}}'" class = "btn btn-secondary">Dodaj ksiazke</button> --}}
        @livewire('users-table-view')
    </div>

@endsection
