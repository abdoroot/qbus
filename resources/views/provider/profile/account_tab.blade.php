<div class="tab-pane {{ $active == 'account' ? 'active' : '' }}" id="account" role="tabpanel">
    <div class="card-body">
        {!! Form::model($account, ['route' => 'provider.profile.account']) !!}
            {!! Form::hidden('provider_id', $provider->id) !!}
            {!! Form::hidden('active', $account->active) !!}
            {!! Form::hidden('role', $account->role) !!}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>@lang('models/accounts.fields.username') *</label>
                    {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : '')]) !!}
                    @error('username')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('models/accounts.fields.email')</label>
                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                    @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label for="phone">@lang('models/accounts.fields.phone')</label>
                    {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) !!}
                    @error('phone')
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