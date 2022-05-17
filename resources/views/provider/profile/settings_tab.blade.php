<div class="tab-pane {{ $active == 'settings' ? 'active' : '' }}" id="settings" role="tabpanel">
    <div class="card-body">
        {!! Form::model($provider, ['route' => 'provider.profile.settings', 'files' => 'on']) !!}
            {!! Form::hidden('provider', $provider->id) !!}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.name') *</label>
                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.email') *</label>
                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="phone">@lang('models/providers.fields.phone') *</label>
                    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                    @error('phone')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.address') *</label>
                    {!! Form::text('address', null, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : '')]) !!}
                    @error('address')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="image">@lang('models/providers.fields.image') </label>
                    <div class="custom-file">
                        {!! Form::file('image', ['id' => 'image', 'class' => 'custom-file-input' . ($errors->has('image') ? ' is-invalid' : '')]) !!}
                        <label class="custom-file-label" data-browse="@lang('msg.browse')" for="image">
                            @if(!is_null($provider->image)) {{ $provider->image }} @else @lang('msg.upload_file') @endif
                        </label>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('image') }}
                            </span> 
                        @endif
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.comm_name') *</label>
                    {!! Form::text('comm_name', null, ['class' => 'form-control' . ($errors->has('comm_name') ? ' is-invalid' : '')]) !!}
                    @error('comm_name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.comm_reg_num') *</label>
                    {!! Form::text('comm_reg_num', null, ['class' => 'form-control' . ($errors->has('comm_reg_num') ? ' is-invalid' : '')]) !!}
                    @error('comm_reg_num')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="comm_reg_img">@lang('models/providers.fields.comm_reg_img') </label>
                    <div class="custom-file">
                        {!! Form::file('comm_reg_img', ['id' => 'comm_reg_img', 'class' => 'custom-file-input' . ($errors->has('comm_reg_img') ? ' is-invalid' : '')]) !!}
                        <label class="custom-file-label" data-browse="@lang('msg.browse')" for="comm_reg_img">
                            @if(!is_null($provider->comm_reg_img)) {{ $provider->comm_reg_img }} @else @lang('msg.upload_file') @endif
                        </label>
                        @if ($errors->has('comm_reg_img'))
                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('comm_reg_img') }}
                            </span> 
                        @endif
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/providers.fields.tax_cert_num') *</label>
                    {!! Form::text('tax_cert_num', null, ['class' => 'form-control' . ($errors->has('tax_cert_num') ? ' is-invalid' : '')]) !!}
                    @error('tax_cert_num')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12 add_top_20">
                    <input type="submit" value="@lang('msg.submit')" class="btn btn-primary">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>