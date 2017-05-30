<?php

namespace App\DataTables;

use App\Models\info;
use Form;
use Yajra\Datatables\Services\DataTable;

class infoDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'infos.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $infos = info::query();

        return $this->applyScopes($infos);
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
            'title' => ['name' => 'title', 'title' => __('title'), 'data' => 'title'],
            'link' => ['name' => 'link', 'title' => __('link'), 'data' => 'link'],
            'category' => ['name' => 'category', 'title' => __('category'), 'data' => 'category'],
            'public_date' => ['name' => 'public_date', 'title' => __('public_date'), 'data' => 'public_date'],
            'start_date' => ['name' => 'start_date', 'title' => __('start_date'), 'data' => 'start_date'],
            'end_date' => ['name' => 'end_date', 'title' => __('end_date'), 'data' => 'end_date'],
            'body' => ['name' => 'body', 'title' => __('body'), 'data' => 'body'],
            'display_flg' => ['name' => 'display_flg', 'title' => __('display_flg'), 'data' => 'display_flg'],
            'toppage_flg' => ['name' => 'toppage_flg', 'title' => __('toppage_flg'), 'data' => 'toppage_flg'],
            'important_flg' => ['name' => 'important_flg', 'title' => __('important_flg'), 'data' => 'important_flg'],
            'delete_flg' => ['name' => 'delete_flg', 'title' => __('delete_flg'), 'data' => 'delete_flg'],
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
        return 'infos';
    }
}
