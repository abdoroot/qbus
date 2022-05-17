<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => 'provider.tax_report', 'method' => 'get', 'class' => 'row']) !!}
                    <!-- Date From Field -->
                    <div class="form-group col-sm-5">
                        {!! Form::label('start_date', __('msg.start_date').':') !!}
                        {!! Form::text('start_date', $start_date, ['class' => 'form-control datepicker']) !!}
                    </div>
        
                    <!-- Date To Field -->
                    <div class="form-group col-sm-5">
                        {!! Form::label('end_date', __('msg.end_date').':') !!}
                        {!! Form::text('end_date', $end_date, ['class' => 'form-control datepicker']) !!}
                    </div>

                    <div class="col-sm-2 m-t-30">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">@lang('crud.submit')</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>