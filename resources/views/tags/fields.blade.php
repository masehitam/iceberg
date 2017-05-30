<!-- Id Field -->
<div class="form-group col-sm-6 @if($errors->has('id')) has-error @endif">
    {!! Form::label('id', __('Id').':') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
    {!! $errors->first('id', '<span class="help-block">:message</span>') !!}
</div>

<!-- Postid Field -->
<div class="form-group col-sm-6 @if($errors->has('postid')) has-error @endif">
    {!! Form::label('postid', __('Postid').':') !!}
    {!! Form::number('postid', null, ['class' => 'form-control']) !!}
    {!! $errors->first('postid', '<span class="help-block">:message</span>') !!}
</div>

<!-- Document Class Field -->
<div class="form-group col-sm-6 @if($errors->has('document_class')) has-error @endif">
    {!! Form::label('document_class', __('Document Class').':') !!}
    {!! Form::number('document_class', null, ['class' => 'form-control']) !!}
    {!! $errors->first('document_class', '<span class="help-block">:message</span>') !!}
</div>

<!-- Tag Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('tag')) has-error @endif">
    {!! Form::label('tag', __('Tag').':') !!}
    {!! Form::textarea('tag', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('tag', '<span class="help-block">:message</span>') !!}
</div>

<!-- Created Id Field -->
<div class="form-group col-sm-6 @if($errors->has('created_id')) has-error @endif">
    {!! Form::label('created_id', __('Created Id').':') !!}
    {!! Form::number('created_id', null, ['class' => 'form-control']) !!}
    {!! $errors->first('created_id', '<span class="help-block">:message</span>') !!}
</div>

<!-- Updated Id Field -->
<div class="form-group col-sm-6 @if($errors->has('updated_id')) has-error @endif">
    {!! Form::label('updated_id', __('Updated Id').':') !!}
    {!! Form::number('updated_id', null, ['class' => 'form-control']) !!}
    {!! $errors->first('updated_id', '<span class="help-block">:message</span>') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tags.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
