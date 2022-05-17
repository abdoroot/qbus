<div class="tab-pane {{ $active == 'settings' ? 'active' : '' }}" id="settings" role="tabpanel">
    <div class="card-body">
        {!! Form::model($admin, ['route' => 'admin.profile.settings', 'files' => 'on']) !!}
            {!! Form::hidden('admin', $admin->id) !!}
            <div class="row">
                <div class="form-group col-sm-12">
                    <label>@lang('msg.name') *</label>
                    {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                    @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-sm-12">
                    <label>@lang('msg.email') *</label>
                    {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}
                    @error('email')
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