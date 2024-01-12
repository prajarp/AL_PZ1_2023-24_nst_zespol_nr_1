@extends('layouts.app')

@section('title', 'Koszyk')

@section('content')
    <div style = "background-color:white">
        @livewire('cart-table-view')
        <a href ="{{ route('summary')}}" ><button class = "btn btn-secondary">Złóż zamowienie</button></a>
    </div>

@endsection