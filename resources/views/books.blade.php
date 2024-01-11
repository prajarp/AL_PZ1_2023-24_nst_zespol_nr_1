@extends('layouts.app')

@section('title', 'Book List')

@section('content')



    {{-- <form method="POST" action="{{ route('categoryFilter') }}">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategorie</h5>
                        <div class="categoryFilter">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="category{{$category->id}}">
                                    <label class="form-check-label" for="category{{$category->id}}">
                                        {{$category->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <button name ="categories" type="submit" width: 50% class="btn btn-primary btn-block">Filtruj</button>
            </div>
            
        </form> --}}

        
  

    @livewire('books-grid-view')

@endsection
