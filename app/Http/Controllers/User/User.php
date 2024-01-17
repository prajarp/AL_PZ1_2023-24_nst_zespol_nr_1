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
        $user = Users::where('email', session()->get('user'))->first();
        $bookId = $request->id;

        $existingRent = BorrowedBooks::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();
        if ($existingRent) {
            return redirect()->route('bookId', $bookId)->with('error', 'Już wypożyczyłes tę książkę.');
        }

        $book = Books::where('id', $bookId)->get()->first();

        $book->decrement('quantity', 1);

        BorrowedBooks::create([
            'user_id' => $user->id,
            'book_id' => $request->id,
        ]);

        return redirect()->route('bookId', $request->id)->with('success', 'Książka została wypożyczona.');
    }

    public function rateBook(Request $request)
    {
        $user = Users::where('email', session()->get('user'))->first();
        $bookId = $request->id;

        $existingRating = Rating::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();

        if ($existingRating) {
            return redirect()->route('bookId', $bookId)->with('error', 'Juz oceniłeś te książkę.');
        }
        $ratingValue = $request->rating;

        if ($ratingValue < 1 || $ratingValue > 5) {
            return redirect()->route('bookId', $request->id)->with('error', 'Podana ocena musi być w zakresie od 1 do 5.');
        }
        Rating::create([
            'book_id' => $request->id,
            'user_id' => $user->id,
            'rating'  => $request->rating,
        ]);

        return redirect()->route('bookId', $request->id)->with('success', 'Oceniłeś książkę.');
    }

    public function addToCart(Request $request)
    {
        if ($request->has('cart')) {

            $user = Users::where('email', session()->get('user'))->first();# czy user ma koszyk
            $userCart = $user->cart()->where('STATUS', 'W trakcie')->first();
            if (!isset($userCart)) {
                $userCart = $user->cart()->create([
                    'STATUS' => 'W trakcie',
                ]);
            }

            $bookInCart = $userCart->cartElements()->where('book_id', $request->id)->first();#sprawdzam czy ksiazka jest w cartElements(na wypadek)

            $availableQuantity = Books::where('id', $request->id)->first()->quantity;#zmienna do ilosci ksiazek o danym id na magazynie

            if (!isset($bookInCart)) {
                if ($availableQuantity < $request->quantity) {
                    return redirect()->route('bookId', $request->id)->with('error', 'Za mały stan magazynowy.');                 #sprawdza ilosc ksiazek w magazynie
                }
                #dodaje ksiazke  do cartElements 
                $userCart->cartElements()->create([
                    'book_id' => $request->id,
                    'quantity' => $request->quantity,
                ]);
            } else {
                if ($availableQuantity < $bookInCart->quantity + $request->quantity) { #jezeli ilosc w magazynie jest mniesza niz (ksiazka ktora jest juz w carcie + domowiona ta sama ksiazka)
                    return redirect()->route('bookId', $request->id)->with('error', 'Za mały stan magazynowy.');
                }
                $userCart->cartElements()->where('book_id', $request->id)->update([ #jezeli mamy ksiazke w cart i znow ja zamowimy to quantity sie zsumuje
                    'quantity' => $bookInCart->quantity + $request->quantity,
                ]);
            }


            return redirect()->route('bookId', $request->id)->with('success', 'Książka dodana do koszyka.');
        }
    }

    public function summary()
    {
        $user = Users::where('email', session()->get('user'))->first();
        $books = $this->getBooksInOpenCartForUser($user);
        
        $sum = 0;
        foreach ($books as $book) {

            $sum += $book->quantity * $book->books->price;
        }

        return view('user.summary', [
            'books' => $books,
            'sum' => $sum,
            'adress' => $user->adress,
        ]);
    }

    public function summaryPost()
    {
        $user = Users::where('email', session()->get('user'))->first();
        $books = $this->getBooksInOpenCartForUser($user);


        foreach ($books as $bookOrdered) {
            $book = Books::findOrFail($bookOrdered->book_id);
            $book->decrement('quantity', $bookOrdered->quantity);
        }
        $user->cart()->where('STATUS', 'W trakcie')->update([
            'STATUS' => 'Zrealizowane'
        ]);

        return redirect()->route('history')->with('success', 'Zamówienie zostało złożone.');
    }


    private function getBooksInOpenCartForUser(Users $user)
    {

        $userCart = $user->cart()->where('STATUS', 'W trakcie')->first();
        $usersCartElements = $userCart->cartElements();
        $books = $usersCartElements->with('books')->get();

        return $books;
    }
}
