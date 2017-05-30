@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Form Question') !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('form_questions.show_fields')
                    <a href="{!! route('formQuestions.index') !!}" class="btn btn-default">{!! __('Back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
