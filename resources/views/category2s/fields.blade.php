<!-- Name Field -->
<div class="form-group col-sm-6 @if($errors->has('name')) has-error @endif">
    {!! Form::label('name', __('Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6 @if($errors->has('parent_id')) has-error @endif">
    {!! Form::label('parent_id', __('Parent Id').':') !!}
    {!! Form::select('parent_id', ['0' => 'select...'], null, ['class' => 'form-control', 'ng-model' => 'input.parent_id', 'ng-options' => "num as name for (num,name) in m_parent_id"]) !!}
    {!! $errors->first('parent_id', '<span class="help-block">:message</span>') !!}
</div>



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
    <a href="{!! route('category2s.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
