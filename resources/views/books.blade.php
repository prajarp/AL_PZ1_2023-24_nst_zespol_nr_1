@extends('layouts.app')

@section('title', 'Lista książek')

@section('content')  
    <label class="text text-secondary">Wyszukaj po tytule, autorze albo kategorii</label>
    @livewire('books-grid-view')

@endsection
