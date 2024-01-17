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
                        <br><br>

                        {{-- ##### ADD TO CART BOOK - POOPS WHEN USER IS NOT LOGGED IN ##### --}}
                        @if(!session()->exists('user'))
                            <label for="quantity">Podaj ilosc:</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" value="1" required>
                        <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#noLoggedAddToCartModal">
                           Dodaj do koszyka
                        </button>
                        <div class="modal fade" id="noLoggedAddToCartModal" tabindex="-1" role="dialog" aria-labelledby="noLoggedAddToCartModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="noLoggedAddToCartModalLabel">Powiadomienie</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Musisz być zalogowanym, żeby robić zakupy. <br>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('login') }}"> <button class = "btn btn-secondary">Zaloguj się</button></a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else 
                        <br>
                            <form method="POST" action="{{ route('addToCart', ['id' => $book->id]) }}">
                                @csrf
                                <label for="quantity">Podaj ilosc:</label>
                                <input type="text" id="quantity" name="quantity" class="form-control" value="1" required>
                                <button name = "cart" type="submit" class="btn btn-secondary btn-block">Dodaj do koszyka</button>
                            </form>
                        @endif
                        <br>

                        {{-- ##### RENT BOOK - POPS UP WHEN USER IS NOT LOGGED IN ##### --}}
                        @if(!session()->exists('user'))
                            <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#noLoggedBorrowModal">
                                Wypożycz ksiażkę
                            </button>
                            <div class="modal fade" id="noLoggedBorrowModal" tabindex="-1" role="dialog" aria-labelledby="noLoggedBorrowModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="noLoggedBorrowModalLabel">Powiadomienie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Musisz być zalogowanym, żeby wypożyczyć książkę. <br>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('login') }}"> <button class = "btn btn-secondary">Zaloguj się</button></a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <br>
                        @else

                        {{-- ##### RENT BOOK - POPS UP WHEN USER IS LOGGED IN ##### --}}
                        <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#loggedBorrowModal">
                            Wypożycz
                        </button>
                        <br>
                        <div class="modal fade" id="loggedBorrowModal" tabindex="-1" role="dialog" aria-labelledby="loggedBorrowModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="loggedBorrowModalLabel">Powiadomienie</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Czy na pewno chcesz wypożyczyć? Darmowe wypożyczyć trwa miesiąc.
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('borrowBook', ['id' => $book->id]) }}">
                                            @csrf
                                            <button name="borrow" type="submit" class="btn btn-secondary">Tak, wypożycz</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- ##### RATING BOOK MODAL - POPS UP WHEN USER IS NOT LOGGED IN##### --}}
                        @if(!session()->exists('user'))
                            <label for="rating">Ocena: </label>
                            <input type="text" id="rating" name="rating" min="1" max="5" class="form-control">
                            <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#rateModal">
                                Oceń produkt
                            </button>
                            <div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="rateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rateModalLabel">Powiadomienie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Musisz być zalogowanym, żeby ocenić produkt. <br>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('login') }}"> <button class = "btn btn-secondary">Zaloguj się</button></a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <form method="POST" action="{{ route('rateBook', ['id' => $book->id]) }}">
                                @csrf
                                <label for="rating">Ocena: </label>
                                <input type="text" id="rating" name="rating" min="1" max="5" class="form-control">
                                <button type="submit" class="btn btn-secondary btn-block">Oceń produkt</button>
                            </form>
                        @endif
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
