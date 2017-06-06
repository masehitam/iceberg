<!-- Name Field -->
<div class="form-group col-sm-6 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', __('Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6 @if($errors->has('type')) has-error @endif">
    {!! Form::label('type', __('Type').':') !!}
    {!! Form::select('type', ['0' => 'none', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
</div>



<!-- Options Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('options')) has-error @endif">
    {!! Form::label('options', __('Options').':') !!}
    {!! Form::textarea('options', null, ['class' => 'form-control']) !!}
    {!! $errors->first('options', '<span class="help-block">:message</span>') !!}
</div>

<!-- Default Value Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('default_value')) has-error @endif">
    {!! Form::label('default_value', __('Default Value').':') !!}
    {!! Form::textarea('default_value', null, ['class' => 'form-control']) !!}
    {!! $errors->first('default_value', '<span class="help-block">:message</span>') !!}
</div>

<!-- Required Field -->
<div class="form-group col-sm-6 @if($errors->has('required')) has-error @endif">
    {!! Form::label('required', __('Required').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('required', false) !!}
        {!! Form::checkbox('required', '1', null) !!} {!! __('1') !!}
    </label>
    {!! $errors->first('required', '<span class="help-block">:message</span>') !!}
</div>

<!-- Min Value Field -->
<div class="form-group col-sm-6 @if($errors->has('min_value')) has-error @endif">
    {!! Form::label('min_value', __('Min Value').':') !!}
    {!! Form::text('min_value', null, ['class' => 'form-control']) !!}
    {!! $errors->first('min_value', '<span class="help-block">:message</span>') !!}
</div>

<!-- Max Value Field -->
<div class="form-group col-sm-6 @if($errors->has('max_value')) has-error @endif">
    {!! Form::label('max_value', __('Max Value').':') !!}
    {!! Form::text('max_value', null, ['class' => 'form-control']) !!}
    {!! $errors->first('max_value', '<span class="help-block">:message</span>') !!}
</div>

<!-- Minlength Field -->
<div class="form-group col-sm-6 @if($errors->has('minlength')) has-error @endif">
    {!! Form::label('minlength', __('Minlength').':') !!}
    {!! Form::text('minlength', null, ['class' => 'form-control']) !!}
    {!! $errors->first('minlength', '<span class="help-block">:message</span>') !!}
</div>

<!-- Maxlength Field -->
<div class="form-group col-sm-6 @if($errors->has('maxlength')) has-error @endif">
    {!! Form::label('maxlength', __('Maxlength').':') !!}
    {!! Form::text('maxlength', null, ['class' => 'form-control']) !!}
    {!! $errors->first('maxlength', '<span class="help-block">:message</span>') !!}
</div>

<!-- Regex Field -->
<div class="form-group col-sm-6 @if($errors->has('regex')) has-error @endif">
    {!! Form::label('regex', __('Regex').':') !!}
    {!! Form::text('regex', null, ['class' => 'form-control']) !!}
    {!! $errors->first('regex', '<span class="help-block">:message</span>') !!}
</div>

<!-- Validation Field -->
<div class="form-group col-sm-6 @if($errors->has('validation')) has-error @endif">
    {!! Form::label('validation', __('Validation').':') !!}
    {!! Form::select('validation', ['0' => 'none', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('validation', '<span class="help-block">:message</span>') !!}
</div>



<!-- Rank Field -->
<div class="form-group col-sm-6 @if($errors->has('rank')) has-error @endif">
    {!! Form::label('rank', __('Rank').':') !!}
    {!! Form::text('rank', null, ['class' => 'form-control']) !!}
    {!! $errors->first('rank', '<span class="help-block">:message</span>') !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('description')) has-error @endif">
    {!! Form::label('description', __('Description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>

<!-- Display Flg Field -->
<div class="form-group col-sm-12 @if($errors->has('display_flg')) has-error @endif">
    {!! Form::label('display_flg', __('Display Flg').':') !!}
    <label class="radio-inline">
        {!! Form::radio('display_flg', "1", null) !!} {!! __('is_display') !!}
    </label>

    <label class="radio-inline">
        {!! Form::radio('display_flg', "0", null) !!} {!! __('is_not_display') !!}
    </label>

{!! $errors->first('display_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('formQuestions.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
