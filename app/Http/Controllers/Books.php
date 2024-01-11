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
        
        // $category = $book->category;
        $test = 'test';

        return view('books', [
            'categories' => $categories,
        ]);
    }
    
    // wyswietlanie po id
    public function show(string $id)
    {
        $book = ModelsBooks::find($id);
        
        $category = $book->category;


        return view(
            'book',
            [
                'book' => $book,
                'category' => $category,
                // 'bookId' => $bookId,
            ]
            );
    
    }
    // $test = $request->category;

    public function categoryFilter(Request $request) 
    {       
    //     $selectedCategories = $request->input('categories', []);

    // // Retrieve the categories to use in filtering
    // $categories = Categories::whereIn('id', $selectedCategories)->get();

    // // Retrieve the books based on the selected categories
    // $books = ModelsBooks::whereIn('category_id', $selectedCategories)->get();

    // Pass the filtered categories and books to the 'books' view
    return view('books', []);

    }
    
}