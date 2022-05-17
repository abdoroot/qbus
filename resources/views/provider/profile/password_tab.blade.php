<div class="tab-pane {{ $active == 'password' ? 'active' : '' }}" id="password" role="tabpanel">
    <div class="card-body">
        {!! Form::open(['route' => 'provider.profile.password']) !!}
            <div class="row">
                <!-- Current Password Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('current_password', __('msg.current_password') . ':') !!}
                    {!! Form::password('current_password', ['id' => 'current_password', 'class' => 'form-control' . ($errors->has('current_password') ? ' is-invalid' : '')]) !!}
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- New Password Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('password', __('msg.new_password') . ':') !!}
                    {!! Form::password('password', ['id' => 'password', 'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '')]) !!}
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- Password Confirmation Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('password_confirmation', __('msg.confirm_password') . ':') !!}
                    {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : '')]) !!}
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-12 add_top_20">
                    <input type="submit" value="@lang('msg.submit')" class="btn btn-primary">
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>


