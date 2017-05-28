<?php

namespace App\DataTables;

use App\Models\product;
use Form;
use Yajra\Datatables\Services\DataTable;

class productDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'products.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $products = product::query();

        return $this->applyScopes($products);
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
            'hid' => ['name' => 'hid', 'title' => __('hid'), 'data' => 'hid'],
            'name' => ['name' => 'name', 'title' => __('name'), 'data' => 'name'],
            'start_date' => ['name' => 'start_date', 'title' => __('start_date'), 'data' => 'start_date'],
            'category' => ['name' => 'category', 'title' => __('category'), 'data' => 'category'],
            'zipcode' => ['name' => 'zipcode', 'title' => __('zipcode'), 'data' => 'zipcode'],
            'company' => ['name' => 'company', 'title' => __('company'), 'data' => 'company'],
            'pref' => ['name' => 'pref', 'title' => __('pref'), 'data' => 'pref'],
            'address01' => ['name' => 'address01', 'title' => __('address01'), 'data' => 'address01'],
            'address02' => ['name' => 'address02', 'title' => __('address02'), 'data' => 'address02'],
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
        return 'products';
    }
}
