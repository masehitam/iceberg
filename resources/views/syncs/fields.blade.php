<!-- Id Field -->
<div class="form-group col-sm-6 @if($errors->has('id')) has-error @endif">
    {!! Form::label('id', __('Id').':') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
    {!! $errors->first('id', '<span class="help-block">:message</span>') !!}
</div>

<!-- Public Date Field -->
<div class="form-group col-sm-6 @if($errors->has('public_date')) has-error @endif">
    {!! Form::label('public_date', __('Public Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('public_date', null, ['class' => 'form-control  pull-right', 'ng-model' => 'input.public_date', 'datetimepicker' => '', 'ng-click' => "calIcon('public_date')"]) !!}
    </div>
    {!! $errors->first('public_date', '<span class="help-block">:message</span>') !!}
</div>


<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('description')) has-error @endif">
    {!! Form::label('description', __('Description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>

<!-- Accept Field -->
<div class="form-group col-sm-6 @if($errors->has('accept')) has-error @endif">
    {!! Form::label('accept', __('Accept').':') !!}
    {!! Form::number('accept', null, ['class' => 'form-control']) !!}
    {!! $errors->first('accept', '<span class="help-block">:message</span>') !!}
</div>

<!-- Finish Field -->
<div class="form-group col-sm-6 @if($errors->has('finish')) has-error @endif">
    {!! Form::label('finish', __('Finish').':') !!}
    {!! Form::number('finish', null, ['class' => 'form-control']) !!}
    {!! $errors->first('finish', '<span class="help-block">:message</span>') !!}
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
    <a href="{!! route('syncs.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
