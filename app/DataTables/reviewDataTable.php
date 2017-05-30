<?php

namespace App\DataTables;

use App\Models\review;
use Form;
use Yajra\Datatables\Services\DataTable;

class reviewDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn(__('action'), 'reviews.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $reviews = review::query();

        return $this->applyScopes($reviews);
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
            'postid' => ['name' => 'postid', 'title' => __('postid'), 'data' => 'postid'],
            'fileid' => ['name' => 'fileid', 'title' => __('fileid'), 'data' => 'fileid'],
            'document_class' => ['name' => 'document_class', 'title' => __('document_class'), 'data' => 'document_class'],
            'comment' => ['name' => 'comment', 'title' => __('comment'), 'data' => 'comment'],
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
        return 'reviews';
    }
}
