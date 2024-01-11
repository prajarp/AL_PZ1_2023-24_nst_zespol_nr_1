@extends('layouts.app')

@section('title', 'Podsumowanie')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Podsumowanie</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Tytul</th>
                <th>Autor</th>
                <th>Kategoria</th>
                <th>Strony</th>
                <th>Cena</th>
                <th>Ilosc</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->books->title }}</td>
                    <td>{{ $book->books->author }}</td>
                    <td>{{ $book->books->category->name }}</td>
                    <td>{{ $book->books->pages }}</td>
                    <td>{{ $book->books->price }} zl</td>
                    <td>{{ $book->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Suma zamowienia</td>
                <td><strong>{{ $suma }}</strong> zl</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Adres dostawy</td>
                <td>{{ $adress }}</td>
            </tr>
        </tbody>
    </table>
</div>
<form method="POST" action = '{{ route('summaryPost') }}'>
    @csrf
    <button class = "btn btn-secondary">Zloz zamowienie</button>
</form>
@endsection
