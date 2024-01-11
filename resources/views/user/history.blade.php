@extends('layouts.app')

@section('title', 'Historia Zamowien')

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    
    <div style = "background-color:white">
        @livewire('history-table-view')
    </div>

@endsection