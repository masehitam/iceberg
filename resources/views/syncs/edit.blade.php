@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! __('Sync') !!}
        </h1>
   </section>
   <div class="content">
       @include('layouts.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sync, ['route' => ['syncs.update', $sync->id], 'method' => 'patch']) !!}

                        @include('syncs.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection