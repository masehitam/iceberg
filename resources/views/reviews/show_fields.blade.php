<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('Id').':') !!}
    <p>{!! $review->id !!}</p>
</div>

<!-- Postid Field -->
<div class="form-group">
    {!! Form::label('postid', __('Postid').':') !!}
    <p>{!! $review->postid !!}</p>
</div>

<!-- Fileid Field -->
<div class="form-group">
    {!! Form::label('fileid', __('Fileid').':') !!}
    <p>{!! $review->fileid !!}</p>
</div>

<!-- Document Class Field -->
<div class="form-group">
    {!! Form::label('document_class', __('Document Class').':') !!}
    <p>{!! $review->document_class !!}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', __('Comment').':') !!}
    <p>{!! $review->comment !!}</p>
</div>

<!-- Created Id Field -->
<div class="form-group">
    {!! Form::label('created_id', __('Created Id').':') !!}
    <p>{!! $review->created_id !!}</p>
</div>

<!-- Updated Id Field -->
<div class="form-group">
    {!! Form::label('updated_id', __('Updated Id').':') !!}
    <p>{!! $review->updated_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('Created At').':') !!}
    <p>{!! $review->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('Updated At').':') !!}
    <p>{!! $review->updated_at !!}</p>
</div>

