<?php

namespace App\Http\Livewire;

use App\Actions\DeleteBook;
use App\Models\Books as ModelsBooks;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\TableView;
use LaravelViews\Facades\UI;

class BooksTableView extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return ModelsBooks::query();
    }

    public $paginate = 10;

    public $searchBy = ['id', 'title', 'author', 'category.name'];

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['ID', 'TYTUŁ', 'AUTOR', 'KATEGORIA', 'ID KATEGORII', 'ILOŚĆ STRON', 'CENA', 'SZTUK', 'img_path'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row(ModelsBooks $model): array
    {
        return [
            $model->id,
            UI::editable($model, 'title'),
            UI::editable($model, 'author'),
            $model->category->name,
            UI::editable($model, 'category_id'),
            UI::editable($model, 'pages'),
            UI::editable($model, 'price'),
            UI::editable($model, 'quantity'),   
            UI::editable($model, 'img_path'),
        ];
    }

    public function update(ModelsBooks $book, $data)
    {
            $book->update($data);
    }

    protected function actionsByRow()
    {
        return [
            new DeleteBook,
        ];
    }
    
}
