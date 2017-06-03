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
    {!! Form::select('category', ['0' => '指定なし', '1' => 'ＮＥＷＳ', '2' => '製品', '3' => 'イベント', '4' => 'お知らせ', '5' => 'その他'], null, ['class' => 'form-control', 'multiple' => '']) !!}
    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
</div>



<!-- Public Date Field -->
<div class="form-group col-sm-6 @if($errors->has('public_date')) has-error @endif">
    {!! Form::label('public_date', __('Public Date').':') !!}
    <div class="input-group date">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        {!! Form::text('public_date', null, ['class' => 'form-control  pull-right datetimepick']) !!}
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
        {!! Form::text('start_date', null, ['class' => 'form-control  pull-right datetimepick']) !!}
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
        {!! Form::text('end_date', null, ['class' => 'form-control  pull-right datetimepick']) !!}
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
<div class="form-group col-sm-12 @if($errors->has('display_flg')) has-error @endif">
    {!! Form::label('display_flg', __('Display Flg').':') !!}
    <label class="radio-inline">
        {!! Form::radio('display_flg', "1", null) !!} {!! __('表示する') !!}
    </label>

    <label class="radio-inline">
        {!! Form::radio('display_flg', "0", null) !!} {!! __('表示しない') !!}
    </label>

{!! $errors->first('display_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Toppage Flg Field -->
<div class="form-group col-sm-12 @if($errors->has('toppage_flg')) has-error @endif">
    {!! Form::label('toppage_flg', __('Toppage Flg').':') !!}
    <label class="radio-inline">
        {!! Form::radio('toppage_flg', "1", null) !!} {!! __('表示する') !!}
    </label>

    <label class="radio-inline">
        {!! Form::radio('toppage_flg', "0", null) !!} {!! __('表示しない') !!}
    </label>

{!! $errors->first('toppage_flg', '<span class="help-block">:message</span>') !!}
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('infos.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
