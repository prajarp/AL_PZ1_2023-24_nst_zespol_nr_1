@extends('layouts.app')

@section('title', 'Books List')

@section('content')
    <div style = "background-color:white">
        <button onclick="window.location='{{ route('addBook')}}'" class = "btn btn-secondary">Dodaj książkę</button>
        @livewire('books-table-view')
    </div>

@endsection
