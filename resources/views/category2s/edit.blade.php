@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Category2') !!}
        </h1>
   </section>
   <div class="content">
       @include('layouts.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category2, ['route' => ['category2s.update', $category2->id], 'method' => 'patch']) !!}

                        @include('category2s.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection