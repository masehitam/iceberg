@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Category2') !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('category2s.show_fields')
                    <a href="{!! route('category2s.index') !!}" class="btn btn-default">{!! __('Back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
