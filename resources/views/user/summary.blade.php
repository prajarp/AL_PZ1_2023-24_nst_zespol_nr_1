@extends('layouts.app')

@section('title', 'Podsumowanie')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Podsumowanie</h1>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>TYTUŁ</th>
                <th>AUTOR</th>
                <th>KATEGORIA</th>
                <th>STRONY</th>
                <th>CENA</th>
                <th>ILOŚĆ</th>
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
                <td>Suma zamówienia</td>
                <td><strong>{{ $sum }}</strong> zł</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Adres dostawy</td>
                <td><strong>{{ $adress }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
<form method="POST" action = '{{ route('summaryPost') }}'>
    @csrf
    <button class = "btn btn-secondary">Potwierdz</button>
</form>
@endsection
