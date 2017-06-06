<!-- Title1 Field -->
<div class="form-group col-sm-6 @if($errors->has('title1')) has-error @endif">
    {!! Form::label('title1', __('Title1').':') !!}
    {!! Form::text('title1', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title1', '<span class="help-block">:message</span>') !!}
</div>

<!-- Subtitle Field -->
<div class="form-group col-sm-6 @if($errors->has('subtitle')) has-error @endif">
    {!! Form::label('subtitle', __('Subtitle').':') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    {!! $errors->first('subtitle', '<span class="help-block">:message</span>') !!}
</div>

<!-- Answer001 Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('answer001')) has-error @endif">
    {!! Form::label('answer001', __('Answer001').':') !!}
    {!! Form::textarea('answer001', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('answer001', '<span class="help-block">:message</span>') !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6 @if($errors->has('email')) has-error @endif">
    {!! Form::label('email', __('Email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6 @if($errors->has('start_date')) has-error @endif">
    {!! Form::label('start_date', __('Start Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('start_date', null, ['class' => 'form-control  pull-right datetimepick']) !!}
    </div>
    {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
</div>


<!-- Number Field -->
<div class="form-group col-sm-6 @if($errors->has('number')) has-error @endif">
    {!! Form::label('number', __('Number').':') !!}
    {!! Form::number('number', null, ['class' => 'form-control']) !!}
    {!! $errors->first('number', '<span class="help-block">:message</span>') !!}
</div>

<!-- Zipcode Field -->
<div class="form-group col-sm-6 @if($errors->has('zipcode')) has-error @endif">
    {!! Form::label('zipcode', __('Zipcode').':') !!}

	<div clss="input-group">
        <div class="col-xs-8" style="padding-left:0;">
            {!! Form::text('zipcode', null, ['class' => 'form-control', 'data-inputmask' => "'mask': '999-9999'"]) !!}
        </div>
        <div class="col-xs-4">
            <span class="input-group-btn" style="padding-left:0px;">
                 <button type="button" class="btn btn-info btn-flat" id="prefSearch">{!! __('prefSearch') !!}</button>
            </span>
        </div>
    </div>
</div>


<!-- Password Field -->
<div class="form-group col-sm-6 @if($errors->has('password')) has-error @endif">
    {!! Form::label('password', __('Password').':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6 @if($errors->has('image')) has-error @endif">
    {!! Form::label('image', 'Image:') !!}
    <div class="input-group">
        {!! Form::text('image', null, ['class' => 'form-control', 'for' => 'image']) !!}
        <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat popup_selector" data-inputid="image">{!! __('Browse') !!}</button>
        </span>
    </div>
    {!! $errors->first('image', '<span class="help-block">:message</span>') !!}
</div>


<!-- Category Field -->
<div class="form-group col-sm-6 @if($errors->has('category')) has-error @endif">
    {!! Form::label('category', __('Category').':') !!}
    {!! Form::select('category', ['0' => 'none', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
</div>



<!-- Pref Field -->
<div class="form-group col-sm-6 @if($errors->has('pref')) has-error @endif">
    {!! Form::label('pref', __('Pref').':') !!}
    {!! Form::select('pref', ['0' => 'select...'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('pref', '<span class="help-block">:message</span>') !!}
</div>



<!-- Popular Field -->
<div class="form-group col-sm-6 @if($errors->has('popular')) has-error @endif">
    {!! Form::label('popular', __('Popular').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('popular', false) !!}
        {!! Form::checkbox('popular', '1', null) !!} {!! __('popular1') !!}
    </label>
    {!! $errors->first('popular', '<span class="help-block">:message</span>') !!}
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
    <a href="{!! route('sample3s.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
