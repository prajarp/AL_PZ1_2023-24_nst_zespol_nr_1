@extends('layouts.app')

@section('title', 'Home')

@section('content')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        section {
            flex: 1;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        /* Dodatkowy styl dla stopki, aby ją umieścić na dole strony */
        html, body {
            height: 100%;
        }
    </style>
<body>
    <header>
        <h1>Sklep z Książkami</h1>
    </header>

    <section>
        <h2>Witaj w naszym sklepie!</h2>

        <p>
            Nasz sklep oferuje szeroki wybór książek, które możesz zakupić lub wypożyczyć.
            Oferujemy bogatą gamę gatunków, od powieści po literaturę fachową.
            Znajdziesz u nas zarówno nowości, jak i klasyki literatury światowej.
        </p>

        <h3>Nasze możliwości:</h3>

        <ul>
            <li>Kupno książek online w prosty sposób.</li>
            <li>Wypożyczanie książek na określony czas.</li>
            <li>Szeroki wybór autorów i gatunków literackich.</li>
            <li>Konkurencyjne ceny i atrakcyjne promocje.</li>
            <!-- Dodaj więcej możliwości -->
        </ul>
    </section>

</body>
@endsection