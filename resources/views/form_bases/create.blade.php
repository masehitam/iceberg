@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Form Base') !!}
        </h1>
    </section>
    <div class="content">
        @include('layouts.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'formBases.store']) !!}

                        @include('form_bases.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
