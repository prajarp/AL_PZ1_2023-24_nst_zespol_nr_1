<?php

namespace App\Http\Livewire;

use App\Models\Books;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Views\GridView;

class BooksGridView extends GridView
{
    /**
     * Sets a model class to get the initial data
     */
    protected $model = Books::class;

    protected $paginate = 28;

    public $maxCols = 4; 

    public $withBackground = True;

    /**
     * Sets the data to every card on the view
     *
     * @param $model Current model for each card
     */
    public $cardComponent = 'components.bookcard';

    public function card($model)
    {
        return [
            'image' => asset('png/books/' .$model->img_path),
            'title' => $model->title,
            'category' => $model->category->name,
            'price' => $model->price . ' zł',
            'rating' => 'Ocena: ' . (round($model->rating()->avg('rating'), 1) ?? 0).' / 5',
        ];
    }
}
