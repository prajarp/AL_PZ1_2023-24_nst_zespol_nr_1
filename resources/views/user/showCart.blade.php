@extends('layouts.app')

@section('title', 'Koszyk')

@section('content')
    <div style = "background-color:white">
        @livewire('cart-table-view')
        <button onclick="window.location='{{ route('summary')}}'" class = "btn btn-secondary">Zloz zamowienie</button>
    </div>

@endsection