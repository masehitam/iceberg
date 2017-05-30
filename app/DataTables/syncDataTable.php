<?php

namespace App\DataTables;

use App\Models\sync;
use Form;
use Yajra\Datatables\Services\DataTable;

class syncDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'syncs.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $syncs = sync::query();

        return $this->applyScopes($syncs);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> '. __('Export'),
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id' => ['name' => 'id', 'title' => __('id'), 'data' => 'id'],
            'public_date' => ['name' => 'public_date', 'title' => __('public_date'), 'data' => 'public_date'],
            'description' => ['name' => 'description', 'title' => __('description'), 'data' => 'description'],
            'accept' => ['name' => 'accept', 'title' => __('accept'), 'data' => 'accept'],
            'finish' => ['name' => 'finish', 'title' => __('finish'), 'data' => 'finish'],
            'created_id' => ['name' => 'created_id', 'title' => __('created_id'), 'data' => 'created_id'],
            'updated_id' => ['name' => 'updated_id', 'title' => __('updated_id'), 'data' => 'updated_id']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'syncs';
    }
}
