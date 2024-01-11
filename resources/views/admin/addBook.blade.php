@extends('layouts.app')

@section('title', 'Book List')

@section('content')
    <div style = "background-color:white">
        <form method="POST" action="{{ route('addBookPost') }}">
            @csrf

            <div class="form-group">
                <label for="title">Tytul:</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            
            <div class="form-group">
                <label for="author">Autor:</label>
                <input type="text" id="author" name="author" class="form-control" value="{{ old('author') }}" required>
            </div>

            <div class="form-group">
                {{-- <label for="category_id">Kategoria:</label>
                <input type="text" id="category_id" name="category_id" class="form-control" value="{{ old('category_id') }}" required> --}}

                <label for="category_id">Kategoria:</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="" selected>Wybierz kategorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="pages">Ilosc stron:</label>
                <input type="text" id="pages" name="pages" class="form-control" value="{{ old('pages') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Cena:</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Ilosc sztuk:</label>
                <input type="text" id="quantity" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
            </div>


            <button type="submit" class="btn btn-primary btn-block">Dodaj ksiazke</button>
        </form>
    </div>

@endsection
