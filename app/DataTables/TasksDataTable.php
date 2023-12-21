<?php

namespace App\DataTables;

use App\Models\Tasks;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TasksDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query->where("user_id", Auth::id());
        return (new EloquentDataTable($query))
            ->addColumn('action', function(Tasks $data) {
                    $id = $data->id;
                    $editRoute = route("edit_link", [$id]);
                    $deleteRoute = route("delete_link", [$id]);
                    $editButton = "<a class='btn btn-warning' href='{$editRoute}'>Edit</a>";
                    $deleteButton = "<a class='btn btn-danger' href='{$deleteRoute}'>Delete</a>";
                    return "{$editButton}{$deleteButton}";
                }
            )
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Tasks $model): QueryBuilder
    {
        $model->user_id = Auth::id();
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tasks-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('name'),
            Column::make('start'),
            Column::make('end'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Tasks_' . date('YmdHis');
    }
}
