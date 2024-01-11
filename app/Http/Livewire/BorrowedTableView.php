<?php

namespace App\Http\Livewire;

use App\Actions\BorrowAction;
use App\Models\BorrowedBooks;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\TableView;

class BorrowedTableView extends TableView
{
     /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return BorrowedBooks::query();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['Tytul', 'Autor', 'Data wypozyczenia', 'Data oddania'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row(BorrowedBooks $model): array
    {
        
        
        // dd($model->books);
        return [
            $model->books->title,
            $model->books->author,
            $model->created_at->format("Y-m-d"),
            $model->created_at->addDays(30)->format("Y-m-d"),
        ];
    }

    public function update(BorrowedBooks $user, $data)
    {
        $user->update($data);
    }

    protected function actionsByRow()
    {
        return [
            new BorrowAction,
        ];
    }
}
