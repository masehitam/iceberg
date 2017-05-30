<?php

namespace App\DataTables;

use App\Models\FormBase;
use Form;
use Yajra\Datatables\Services\DataTable;

class FormBaseDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'form_bases.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $formBases = FormBase::query();

        return $this->applyScopes($formBases);
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
            'type' => ['name' => 'type', 'title' => __('type'), 'data' => 'type'],
            'title' => ['name' => 'title', 'title' => __('title'), 'data' => 'title'],
            'start_date' => ['name' => 'start_date', 'title' => __('start_date'), 'data' => 'start_date'],
            'end_date' => ['name' => 'end_date', 'title' => __('end_date'), 'data' => 'end_date'],
            'image' => ['name' => 'image', 'title' => __('image'), 'data' => 'image']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'formBases';
    }
}
