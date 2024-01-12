@extends('layouts.app')

@section('title', 'Users List')

@section('content')
    <div style = "background-color:white">
        <a href="{{ route('addBook')}}'"> <button class = "btn btn-secondary">Dodaj ksiazke</button></a>
        @livewire('users-table-view')
    </div>

@endsection
