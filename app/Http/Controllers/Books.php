<?php

namespace App\Http\Controllers;

use App\Models\Books as ModelsBooks;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Books extends Controller
{
    public function books(Request $request)
    {
        $categories = Categories::all();

        return view('books', [
            'categories' => $categories,
        ]);
    }

    public function show(string $id)
    {
        session()->put('id', $id);

        $book = ModelsBooks::find($id);

        $category = $book->category;

        return view(
            'book',
            [
                'book' => $book,
                'category' => $category,
            ]
        );
    }
}