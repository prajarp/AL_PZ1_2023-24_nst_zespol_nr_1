<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\BorrowedBooks;
use App\Models\Rating;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User extends Controller
{
    public function showCart()
    {
        return view('user.showCart');
    }

    public function showBooks()
    {
        return view('user.showBooks');
    }

    public function borrowBook(Request $request)
    {
        // if($request->has('borrowedBooks')) {
        //     $user = Users::where('email', session()->get('user'))->first();
        //     dd($user);
        // }
        $user = Users::where('email', session()->get('user'))->first();
        $bookId = $request->id;
        $existingRent = BorrowedBooks::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();
        if ($existingRent) {
            return redirect()->route('bookId', $bookId)->with('error', 'Wypozyczyles te ksiazke.');
        }

        $book = Books::where('id', $bookId)->get()->first();
        
        $book->decrement('quantity', 1);
        
        BorrowedBooks::create([
            'user_id' => $user->id,
            'book_id' => $request->id,
        ]);
        // dd($request->id);
        // BorrowedBooks::create([
        //     'user_id'=>$user_id,
        //     'book_id'=>$user_id
        // ]);

        return redirect()->route('bookId', $request->id)->with('success', 'Ksiazka zostala wypozyczona.');
    }

    public function rateBook(Request $request)
    {
        $user = Users::where('email', session()->get('user'))->first();
        $bookId = $request->id;

        $existingRating = Rating::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();

        if ($existingRating) {
            return redirect()->route('bookId', $bookId)->with('error', 'Juz oceniles te ksiazke.');
        }
        $ratingValue = $request->rating;

        if ($ratingValue < 1 || $ratingValue > 5) {
            return redirect()->route('bookId', $request->id)->with('error', 'Podana ocena musi być w zakresie od 1 do 5.');
        }
        // dd($request->id);
        Rating::create([
            'book_id' => $request->id,
            'user_id' => $user->id,
            'rating'  => $request->rating,
        ]);

        return redirect()->route('bookId', $request->id)->with('success', 'Oceniles ksiazke.');
    }

    public function addToCart(Request $request)
    {
        if ($request->has('cart')) {

            # czy user ma koszyk
            $user = Users::where('email', session()->get('user'))->first();
            $userCart = $user->cart()->where('STATUS', 'OPEN')->first();
            if (!isset($userCart)) {
                $userCart = $user->cart()->create([
                    'STATUS' => 'W trakcie',
                ]);
            }
            #sprawdzam czy ksiazka jest w cartElements(na wypadek)
            $bookInCart = $userCart->cartElements()->where('book_id', $request->id)->first();
            // dd($bookInCart);

            #zmienna do ilosci ksiazek o danym id na magazynie
            $availableQuantity = Books::where('id', $request->id)->first()->quantity;

            if (!isset($bookInCart)) {
                #sprawdza ilosc ksiazek w magazynie
                if ($availableQuantity < $request->quantity) {
                    return redirect()->route('bookId', $request->id)->with('error', 'Za maly stan magazynowy.');
                }
                #dodaje ksiazke  do cartElements 
                $userCart->cartElements()->create([
                    'book_id' => $request->id,
                    'quantity' => $request->quantity,

                ]);
            } else {
                #jezeli ilosc w magazynie jest mniesza niz (ksiazka ktora jest juz w carcie + domowiona ta sama ksiazka)
                if ($availableQuantity < $bookInCart->quantity + $request->quantity) {
                    return redirect()->route('bookId', $request->id)->with('error', 'Za maly stan magazynowy.');
                }
                #jezeli mamy ksiazke w cart i znow ja zamowimy to quantity sie zsumuje
                $userCart->cartElements()->where('book_id', $request->id)->update([
                    'quantity' => $bookInCart->quantity + $request->quantity,
                ]);
            }


            return redirect()->route('bookId', $request->id)->with('success', 'Ksiazka dodana do koszyka.');
        }
    }

    public function summary()
    {
        $user = Users::where('email', session()->get('user'))->first();
        $books = $this->getBooksInOpenCartForUser($user);

        // dd($books->toArray());

        $suma = 0;
        #TODO zmien zmienna na anglojezyczna
        foreach ($books as $book) {

            $suma += $book->quantity * $book->books->price;
        }

        // dd($book->books->author);


        return view('user.summary', [
            'books' => $books,
            'suma' => $suma,
            'adress' => $user->adress,
        ]);
    }

    public function summaryPost()
    {
        $user = Users::where('email', session()->get('user'))->first();
        $books = $this->getBooksInOpenCartForUser($user);

        // $state = 0;

        foreach ($books as $bookOrdered) {
            $book = Books::findOrFail($bookOrdered->book_id); 
            $book->decrement('quantity', $bookOrdered->quantity);  
        }
        // dd($book->quantity);
        $user->cart()->where('STATUS', 'W trakcie')->update([
            'STATUS' => 'Zrealizowane'
        ]);
            
        return redirect()->route('history')->with('success', 'Zamowienie zostalo zlozone.');
    }

    
    private function getBooksInOpenCartForUser(Users $user)
    {
        
        $userCart = $user->cart()->where('STATUS', 'W trakcie')->first();
        $usersCartElements = $userCart->cartElements();
        $books = $usersCartElements->with('books')->get();

        return $books;
    }

    
}
