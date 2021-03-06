{!! Form::open(['route' => ['category2s.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('category2s.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('category2s.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('".__('Are you sure?')."')"
    ]) !!}
</div>
{!! Form::close() !!}
