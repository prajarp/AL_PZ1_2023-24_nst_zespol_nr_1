<?php

namespace App\Http\Livewire;

use App\Actions\CartAction;
use App\Models\Books;
use App\Models\Cart;
use App\Models\CartElements;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\TableView;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithAlerts;

class CartTableView extends TableView
{
    use WithAlerts;
    /**
     * Sets a model class to get the initial data
     */
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return CartElements::join('cart', 'cart.id', '=', 'cart_elements.cart_id')
        ->join('books', 'books.id', '=', 'cart_elements.book_id')
        ->select([
            'cart_elements.id',
            'cart_elements.cart_id',
            'cart_elements.book_id',
            'cart_elements.quantity',
            'cart_elements.created_at',
            'cart_elements.updated_at',
            'cart.user_id',
            'cart.STATUS',
        ])
        ->where('cart.STATUS', 'W trakcie');
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['AUTOR' ,'TYTUŁ', 'CENA', 'ILOŚĆ', 'SUMA ZAMÓWIENIA'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */

    public function update(CartElements $cartElement, $data)
{
    $newQuantity = (int)$data['quantity'];

    $availableQuantity = $cartElement->books->quantity;

    if ($newQuantity > $availableQuantity) {
        $this->error('Za mały stan magazynowy.');
        return;
    }

    $cartElement->update(['quantity' => $newQuantity]);
}

    public function row($model): array
    {
        return [
            $model->books->title,
            $model->books->author,
            $model->books->price . ' zł',
            UI::editable($model, 'quantity'),
            ($model->books->price) * ($model->quantity) . ' zł',
        ];
    }

    protected function actionsByRow()
    {
        return [
            new CartAction,
        ];
    }
}
