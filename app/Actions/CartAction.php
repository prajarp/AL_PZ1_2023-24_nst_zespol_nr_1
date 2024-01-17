<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class CartAction extends Action
{

    public function getConfirmationMessage($item = null)
    {
        return 'Na pewno chcesz usunąć produkt z koszyka?';
    }
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Usuń książkę";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "trash-2";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        
        $model->delete();
        
        $this->success('Usunięto produkt z koszyka.');
    }
}
