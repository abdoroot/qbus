<!-- Publish Field -->
<div class="form-group col-sm-12">
    <div class="custom-control custom-switch">
        {!! Form::hidden('publish', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('publish', '1', null, ['class' => 'custom-control-input', 'id' => 'publish']) !!}
        {!! Form::label('publish', __('models/reviews.fields.publish'), ['class' => 'custom-control-label']) !!}
    </div>
</div>