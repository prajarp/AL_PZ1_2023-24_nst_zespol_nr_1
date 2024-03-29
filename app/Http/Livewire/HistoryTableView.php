<?php

namespace App\Http\Livewire;

use App\Http\Controllers\User\User;
use App\Models\Books;
use App\Models\Cart;
use App\Models\CartElements;
use App\Models\Users;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class HistoryTableView extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        $user = Users::where('email', session()->get('user'))->first();

        return Cart::where('user_id', $user->id)->where('STATUS', 'Zrealizowane')->orderByDesc('updated_at');
        
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['ZAMOWIENIE ', 'PRODUKTY', 'SUMA ZAMOWIENIA', 'DATA ZAMOWIENIA', 'STATUS'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {   
        $bookNames = [];
        $sum = 0;

        foreach ($model->cartElements as $cartElement) {
            if($cartElement->books->get()) {
                $book = Books::find($cartElement->book_id);
                $sum += $book->price * $cartElement->quantity;
                $bookNames[] = $cartElement->quantity . ' x '. '<b>'.$book->author . ' </b> ' . $book->title;
            }
        }

        return [
            $model->id,
            implode("<br>",$bookNames),
            $sum. " zł", 
            $model->updated_at->format("Y-m-d"),
            $model->STATUS
        ];
    }
}
