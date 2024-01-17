<?php

namespace App\Http\Livewire;

use App\Models\Books;
use App\Models\Categories;
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
    
    public $searchBy = ['title', 'author', 'category.name'];

    public function sortableBy()
    {
        return [
            'CENA' => 'price',
        ];
    }

    public function options(): array
    {
        // You can dynamically fetch the categories from your database
        
        $categories = Categories::pluck('name', 'name')->toArray();
        return $categories;
    }

    public function apply(Builder $query, $value): Builder
    {
        // Assuming $value is an array with category names (e.g., ['Mystery', 'Fiction'])
        return $query->whereIn('id_category', function ($subquery) use ($value) {
            $subquery->select('id')->from('categories')->whereIn('name', $value);
        });
    }



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
            'author' => $model->author,
            'category' => $model->category->name,
            'price' => $model->price . ' zł',
            'rating' => 'Ocena: ' . (round($model->rating()->avg('rating'), 1) ?? 0).' / 5',
        ];
    }
    
}
