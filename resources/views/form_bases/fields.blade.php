<!-- Type Field -->
<div class="form-group col-sm-6 @if($errors->has('type')) has-error @endif">
    {!! Form::label('type', __('Type').':') !!}
    {!! Form::select('type', ['0' => 'none', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
</div>



<!-- Title Field -->
<div class="form-group col-sm-6 @if($errors->has('title')) has-error @endif">
    {!! Form::label('title', __('Title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6 @if($errors->has('start_date')) has-error @endif">
    {!! Form::label('start_date', __('Start Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('start_date', null, ['class' => 'form-control  pull-right', 'datepicker' => '']) !!}
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
        {!! Form::text('end_date', null, ['class' => 'form-control  pull-right', 'datepicker' => '']) !!}
    </div>
    {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
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


<!-- Limit Cnt Field -->
<div class="form-group col-sm-6 @if($errors->has('limit_cnt')) has-error @endif">
    {!! Form::label('limit_cnt', __('Limit Cnt').':') !!}
    {!! Form::text('limit_cnt', null, ['class' => 'form-control']) !!}
    {!! $errors->first('limit_cnt', '<span class="help-block">:message</span>') !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('body')) has-error @endif">
    {!! Form::label('body', __('Body').':') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
</div>

<!-- Mail Title Field -->
<div class="form-group col-sm-6 @if($errors->has('mail_title')) has-error @endif">
    {!! Form::label('mail_title', __('Mail Title').':') !!}
    {!! Form::text('mail_title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('mail_title', '<span class="help-block">:message</span>') !!}
</div>

<!-- Mail Body Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('mail_body')) has-error @endif">
    {!! Form::label('mail_body', __('Mail Body').':') !!}
    {!! Form::textarea('mail_body', null, ['class' => 'form-control']) !!}
    {!! $errors->first('mail_body', '<span class="help-block">:message</span>') !!}
</div>

<!-- Send Flg Field -->
<div class="form-group col-sm-6 @if($errors->has('send_flg')) has-error @endif">
    {!! Form::label('send_flg', __('Send Flg').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('send_flg', false) !!}
        {!! Form::checkbox('send_flg', '1', null) !!} {!! __('1') !!}
    </label>
    {!! $errors->first('send_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Comp Msg Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('comp_msg')) has-error @endif">
    {!! Form::label('comp_msg', __('Comp Msg').':') !!}
    {!! Form::textarea('comp_msg', null, ['class' => 'form-control']) !!}
    {!! $errors->first('comp_msg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Aliase Field -->
<div class="form-group col-sm-6 @if($errors->has('aliase')) has-error @endif">
    {!! Form::label('aliase', __('Aliase').':') !!}
    {!! Form::text('aliase', null, ['class' => 'form-control']) !!}
    {!! $errors->first('aliase', '<span class="help-block">:message</span>') !!}
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

<!-- Ad Tag Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('ad_tag')) has-error @endif">
    {!! Form::label('ad_tag', __('Ad Tag').':') !!}
    {!! Form::textarea('ad_tag', null, ['class' => 'form-control']) !!}
    {!! $errors->first('ad_tag', '<span class="help-block">:message</span>') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('formBases.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
