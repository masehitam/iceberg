<!-- Parent Id Field -->
<div class="form-group col-sm-6 @if($errors->has('parent_id')) has-error @endif">
    {!! Form::label('parent_id', __('Parent Id').':') !!}
    {!! Form::select('parent_id', ['0' => 'select...'], null, ['class' => 'form-control', 'ng-model' => 'input.parent_id', 'ng-options' => "num as name for (num,name) in m_parent_id"]) !!}
    {!! $errors->first('parent_id', '<span class="help-block">:message</span>') !!}
</div>



<!-- Answer001 Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('answer001')) has-error @endif">
    {!! Form::label('answer001', __('Answer001').':') !!}
    {!! Form::textarea('answer001', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('answer001', '<span class="help-block">:message</span>') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('formAnswers.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
