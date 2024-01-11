@extends('layouts.app')

@section('title', 'Wypozyczone ksiazki')

@section('content')
    <div style = "background-color:white">
        @livewire('borrowed-table-view')
    </div>

@endsection