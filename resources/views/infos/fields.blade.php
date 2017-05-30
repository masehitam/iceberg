<!-- Id Field -->
<div class="form-group col-sm-6 @if($errors->has('id')) has-error @endif">
    {!! Form::label('id', __('Id').':') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
    {!! $errors->first('id', '<span class="help-block">:message</span>') !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6 @if($errors->has('title')) has-error @endif">
    {!! Form::label('title', __('Title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
</div>

<!-- Link Field -->
<div class="form-group col-sm-6 @if($errors->has('link')) has-error @endif">
    {!! Form::label('link', __('Link').':') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
    {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6 @if($errors->has('category')) has-error @endif">
    {!! Form::label('category', __('Category').':') !!}
    {!! Form::number('category', null, ['class' => 'form-control']) !!}
    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
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


<!-- Start Date Field -->
<div class="form-group col-sm-6 @if($errors->has('start_date')) has-error @endif">
    {!! Form::label('start_date', __('Start Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('start_date', null, ['class' => 'form-control  pull-right', 'ng-model' => 'input.start_date', 'datetimepicker' => '', 'ng-click' => "calIcon('start_date')"]) !!}
    </div>
    {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
</div>


<!-- End Date Field -->
<div class="form-group col-sm-6 @if($errors->has('end_date')) has-error @endif">
    {!! Form::label('end_date', __('End Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('end_date', null, ['class' => 'form-control  pull-right', 'ng-model' => 'input.end_date', 'datetimepicker' => '', 'ng-click' => "calIcon('end_date')"]) !!}
    </div>
    {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
</div>


<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('body')) has-error @endif">
    {!! Form::label('body', __('Body').':') !!}
    {!! Form::textarea('body', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
</div>

<!-- Display Flg Field -->
<div class="form-group col-sm-6 @if($errors->has('display_flg')) has-error @endif">
    {!! Form::label('display_flg', __('Display Flg').':') !!}
    {!! Form::number('display_flg', null, ['class' => 'form-control']) !!}
    {!! $errors->first('display_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Toppage Flg Field -->
<div class="form-group col-sm-6 @if($errors->has('toppage_flg')) has-error @endif">
    {!! Form::label('toppage_flg', __('Toppage Flg').':') !!}
    {!! Form::number('toppage_flg', null, ['class' => 'form-control']) !!}
    {!! $errors->first('toppage_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Important Flg Field -->
<div class="form-group col-sm-6 @if($errors->has('important_flg')) has-error @endif">
    {!! Form::label('important_flg', __('Important Flg').':') !!}
    {!! Form::number('important_flg', null, ['class' => 'form-control']) !!}
    {!! $errors->first('important_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Delete Flg Field -->
<div class="form-group col-sm-6 @if($errors->has('delete_flg')) has-error @endif">
    {!! Form::label('delete_flg', __('Delete Flg').':') !!}
    {!! Form::number('delete_flg', null, ['class' => 'form-control']) !!}
    {!! $errors->first('delete_flg', '<span class="help-block">:message</span>') !!}
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
    <a href="{!! route('infos.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
