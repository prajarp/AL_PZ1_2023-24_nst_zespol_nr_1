<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function maintainBooks()
    {
        return view('admin/books');
    }

    public function maintainUsers()
    {
        return view('admin/users');
    }

    public function addBook()
    {

        $categories = Categories::all();

        return view('admin.addBook', [
            'categories' => $categories,
        ]);
    }

    public function addBookPost(Request $request)
    {   
        $imgPath = 'book.png';

        Books::create([
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'pages' => $request->pages,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'img_path' => $imgPath,
        ]);
        return redirect()->route('maintainBooks')->with('success', 'Książka została dodana.');
    }
}
