

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('formAnswers.index') !!}" class="btn btn-default">{!! __('Cancel') !!}</a>
</div>
