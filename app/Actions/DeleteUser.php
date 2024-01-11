<?php

namespace App\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class DeleteUser extends Action
{
    use Confirmable;

    public function getConfirmationMessage($item = null)
    {
        return 'Uzytkownik zostanie permametnie usuniety. Czy na pewno chcesz to zrobic?';
    }
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "Usun uzytkownika";

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
        $this->success('Uzytkownik zostal usuniety.');
    }
}
