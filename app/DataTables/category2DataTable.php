<?php

namespace App\DataTables;

use App\Models\category2;
use Form;
use Yajra\Datatables\Services\DataTable;

class category2DataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'category2s.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $category2s = category2::query();

        return $this->applyScopes($category2s);
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
            'name' => ['name' => 'name', 'title' => __('name'), 'data' => 'name'],
            'parent_id' => ['name' => 'parent_id', 'title' => __('parent_id'), 'data' => 'parent_id'],
            'level' => ['name' => 'level', 'title' => __('level'), 'data' => 'level'],
            'rank' => ['name' => 'rank', 'title' => __('rank'), 'data' => 'rank'],
            'image' => ['name' => 'image', 'title' => __('image'), 'data' => 'image'],
            'top_image' => ['name' => 'top_image', 'title' => __('top_image'), 'data' => 'top_image'],
            'description' => ['name' => 'description', 'title' => __('description'), 'data' => 'description'],
            'position' => ['name' => 'position', 'title' => __('position'), 'data' => 'position'],
            'display_flg' => ['name' => 'display_flg', 'title' => __('display_flg'), 'data' => 'display_flg']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'category2s';
    }
}
