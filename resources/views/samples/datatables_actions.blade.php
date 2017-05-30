{!! Form::open(['route' => ['samples.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <!--<a href="{{ route('samples.show', $id) }}" class='btn btn-default btn-sm'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>-->
    <a href="{{ route('samples.edit', $id) }}" class='btn btn-default btn-sm'>
        <i class="glyphicon glyphicon-pencil"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm',
        'onclick' => "return confirm('".__('Are you sure?')."')"
    ]) !!}
</div>
{!! Form::close() !!}
