<?php

namespace App\Http\Livewire;

use App\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EmployeesDatatable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    public $posts;

    public function builder()
    {
        return Employee::query('order by created_at');
    }

    public function columns()
    {
        return [
            Column::name('id'),
            Column::name('fullname')->filterable()->searchable(),
            Column::name('IDNumber')->filterable()->searchable(),
            Column::name('byname')->filterable()->searchable(),
            Column::name('designation')->filterable()->searchable(),
            Column::name('avatar')->filterable()->searchable(),
            DateColumn::name('created_at')->filterable()->searchable()->label('Date Created'),
            Column::callback(['id', 'fullname', 'byname', 'designation', 'IDNumber', 'avatar'], function ($id, $fullname, $byname, $designation, $IDNumber, $avatar) {
                return view('actions.action1', ['id' => $id, 'fullname' => $fullname, 'designation' => $designation, 'byname' => $byname, 'IDNumber' => $IDNumber, 'avatar' => $avatar]);
            }),

        ];
    }
}
