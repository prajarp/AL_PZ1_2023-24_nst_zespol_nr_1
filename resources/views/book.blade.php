@extends('layouts.app')

@section('title', 'Informacje o książce')

@section('content')

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="book">
                <img src="{{ asset('png/books/'. $book->img_path) }}" class="book-img-top" width="190" height="220">
                <hr>
                <div class="book-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <h6 class="book-author"><strong>Autor:</strong> {{ $book->author }}</h6>
                        <p class="book-text">
                            <strong>Kategoria:</strong> {{ $category->name }}
                            <br>
                            <strong>Cena:</strong> {{ $book->price }} zł
                            <br>
                            <strong>Strony:</strong> {{ $book->pages }}
                            <br>
                            <strong>Ocena uzytkownikow:</strong> {{ round($book->rating()->avg('rating'), 1) ?? 0 }} / 5
                        </p>
                        <br>
                        <br>
                        <form method="POST" action="{{ route('addToCart', ['id' => $book->id]) }}">
                            @csrf
                            <label for="quantity">Podaj ilosc:</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" value="1" required>
                            <button name = "cart" type="submit" class="btn btn-primary btn-block">Dodaj do koszyka</button>
                        </form>
                        
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#borrowModal">
                            Wypożycz
                        </button>
                        <br>
                        <div class="modal fade" id="borrowModal" tabindex="-1" role="dialog" aria-labelledby="borrowModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="borrowModalLabel">Potwierdzenie wypożyczenia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Czy na pewno chcesz wypożyczyć? Darmowe wypozyczenie trwa miesiac.
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('borrowBook', ['id' => $book->id]) }}">
                                            @csrf
                                            <button name="borrow" type="submit" class="btn btn-primary">Tak, wypożycz</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <form method="POST" action="{{ route('rateBook', ['id' => $book->id]) }}">
                            @csrf
                            <label for="rating">Ocena: </label>
                            <input type="text" id="rating" name="rating" min="1" max="5" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block">Ocen produkt</button>
                        </form>

                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

@endsection
