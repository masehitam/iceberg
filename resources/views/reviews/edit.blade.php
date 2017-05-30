@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Review') !!}
        </h1>
   </section>
   <div class="content">
       @include('layouts.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($review, ['route' => ['reviews.update', $review->id], 'method' => 'patch']) !!}

                        @include('reviews.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection