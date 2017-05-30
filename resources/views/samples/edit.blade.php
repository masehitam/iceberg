@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Sample') !!}
        </h1>
   </section>
   <div class="content">
       @include('layouts.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sample, ['route' => ['samples.update', $sample->id], 'method' => 'patch']) !!}

                        @include('samples.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection