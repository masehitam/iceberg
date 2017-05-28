<!-- Name Field -->
<div class="form-group col-sm-6 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', __('Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
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
<div class="clearfix"></div>


<!-- Category Field -->
<div class="form-group col-sm-6 @if($errors->has('category')) has-error @endif">
    {!! Form::label('category', __('Category').':') !!}
    {!! Form::select('category', ['0' => '0', '1' => '1', '2' => '2', '3' => '3'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
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
                 <button type="button" class="btn btn-info btn-flat" id="prefSearch" ng-click="prefSearch()">{!! __('prefSearch') !!}</button>
            </span>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Company Field -->
<div class="form-group col-sm-6 @if($errors->has('company')) has-error @endif">
    {!! Form::label('company', __('Company').':') !!}
    {!! Form::select('company', ['0' => 'select...'], null, ['class' => 'form-control', 'ng-model' => 'input.company', 'ng-options' => "num as name for (num,name) in m_company"]) !!}
    {!! $errors->first('company', '<span class="help-block">:message</span>') !!}
</div>



<!-- Pref Field -->
<div class="form-group col-sm-6 @if($errors->has('pref')) has-error @endif">
    {!! Form::label('pref', __('Pref').':') !!}
    {!! Form::select('pref', ['0' => 'select...'], null, ['class' => 'form-control', 'ng-model' => 'input.pref', 'ng-options' => "num as name for (num,name) in m_pref"]) !!}
    {!! $errors->first('pref', '<span class="help-block">:message</span>') !!}
</div>
<div class="clearfix"></div>


<!-- Address01 Field -->
<div class="form-group col-sm-6 @if($errors->has('address01')) has-error @endif">
    {!! Form::label('address01', __('Address01').':') !!}
    {!! Form::text('address01', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address01', '<span class="help-block">:message</span>') !!}
</div>

<!-- Address02 Field -->
<div class="form-group col-sm-6 @if($errors->has('address02')) has-error @endif">
    {!! Form::label('address02', __('Address02').':') !!}
    {!! Form::text('address02', null, ['class' => 'form-control']) !!}
    {!! $errors->first('address02', '<span class="help-block">:message</span>') !!}
</div>
<div class="clearfix"></div>

<!-- Level Field -->
<div class="form-group col-sm-6 @if($errors->has('level')) has-error @endif">
    {!! Form::label('level', __('Level').':') !!}
    {!! Form::select('level', ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('level', '<span class="help-block">:message</span>') !!}
</div>



<!-- Rank Field -->
<div class="form-group col-sm-6 @if($errors->has('rank')) has-error @endif">
    {!! Form::label('rank', __('Rank').':') !!}
    {!! Form::select('rank', ['0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9'], null, ['class' => 'form-control']) !!}
    {!! $errors->first('rank', '<span class="help-block">:message</span>') !!}
</div>
<div class="clearfix"></div>


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


<!-- Top Image Field -->
<div class="form-group col-sm-6 @if($errors->has('image')) has-error @endif">
    {!! Form::label('top_image', 'Top Image:') !!}
    <div class="input-group">
        {!! Form::text('top_image', null, ['class' => 'form-control', 'for' => 'top_image']) !!}
        <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat popup_selector" data-inputid="top_image">{!! __('Browse') !!}</button>
        </span>
    </div>
    {!! $errors->first('top_image', '<span class="help-block">:message</span>') !!}
</div>
<div class="clearfix"></div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('description')) has-error @endif">
    {!! Form::label('description', __('Description').':') !!}
    {!! Form::textarea('description', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-12 col-lg-12 @if($errors->has('position')) has-error @endif">
    {!! Form::label('position', __('Position').':') !!}
    {!! Form::textarea('position', null, ['class' => 'wysiwyg form-control']) !!}
    {!! $errors->first('position', '<span class="help-block">:message</span>') !!}
</div>

<!-- Display Flg Field -->
<div class="form-group col-sm-12 @if($errors->has('display_flg')) has-error @endif">
    {!! Form::label('display_flg', __('Display Flg').':') !!}
    <label class="radio-inline">
        {!! Form::radio('display_flg', "1", null, ['name' => "iCheck"]) !!} {!! __('表示する') !!}
    </label>

    <label class="radio-inline">
        {!! Form::radio('display_flg', "0", null) !!} {!! __('表示しない') !!}
    </label>

{!! $errors->first('display_flg', '<span class="help-block">:message</span>') !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('products.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
