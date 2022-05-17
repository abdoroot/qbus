<div class="tab-pane {{ $active == 'cities' ? 'active' : '' }}" id="cities" role="tabpanel">
    <div class="card-body">
        <div class="card-body">
            <h4 class="card-title">@lang('models/providers.tabs.cities_title')</h4>
            <h5 class="card-subtitle">@lang('models/providers.tabs.cities_subtitle')</h5>
            {!! Form::open(['route' => 'provider.profile.cities', 'method' => 'post']) !!}
                <div class="form-group p-t-5">
                    {!! Form::select('cities[]', $cities, 
                        $citiesArr = (!is_null(old('cities')) ? old('cities') : $providerCities), 
                        [
                            'multiple' => true, 
                            'class' => 'form-control select2 custom-select' . 
                                ($errors->has('cities') ? ' is-invalid' : ''),
                            'id'=>'cities'
                        ]) !!}
                    @error('cities')
                    <span class="invalid-feedback"> {{ $message }} </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">@lang('crud.save')</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('third_party_stylesheets')
    <!-- Select2 plugins css -->
    <link href="{{ asset('elite/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('third_party_scripts')
    <!-- Select2 Plugin JavaScript -->
    <script src="{{ asset('elite/assets/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

@push('page_scripts')
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endpush