@extends('layouts.app')

@section('title', 'Wypożyczone książki')

@section('content')
    <div style = "background-color:white">
        @livewire('borrowed-table-view')
    </div>

@endsection