@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Form Answer') !!}
        </h1>
   </section>
   <div class="content">
       @include('layouts.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($formAnswer, ['route' => ['formAnswers.update', $formAnswer->id], 'method' => 'patch']) !!}

                        @include('form_answers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection