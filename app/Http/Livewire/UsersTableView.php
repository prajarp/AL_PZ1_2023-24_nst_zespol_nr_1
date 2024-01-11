<?php

namespace App\Http\Livewire;

use App\Actions\DeleteUser;
use App\Models\Users;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class UsersTableView extends TableView
{
    /**
     * Sets a initial query with the data to fill the table
     *
     * @return Builder Eloquent query
     */
    public function repository(): Builder
    {
        return Users::query();
    }

    public $paginate = 10;

    public $searchBy = ['id', 'name', 'email', 'role'];

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return ['ID', 'Nazwa', "Email", 'Haslo', 'Adres', 'Rola'];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->id,
            UI::editable($model, 'name'),
            UI::editable($model, 'email'),
            UI::editable($model, 'password'),
            UI::editable($model, 'adress'),
            UI::editable($model, 'role'),
        ];
    }

    public function update(Users $user, $data)
    {
        $user->update($data);
    }

    protected function actionsByRow()
    {
        return [
            new DeleteUser,
        ];
    }

}