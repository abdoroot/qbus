@extends('admin.layouts.app')

@section('title', __('models/settings.plural'))

@push('page_css')
<link href="{{ asset('elite/modern/dist/css/pages/inbox.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('elite/assets/node_modules/html5-editor/bootstrap-wysihtml5.css') }}" />
@endpush

@section('content')
<div class="row">
    @include('flash::message')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['route' => ['admin.settings.update', $id], 'method' => 'patch', 'class' => 'd-inline', 'files' => 'on']) !!}
                    <div class="row">
                        @foreach($settings as $setting)
                            @include('admin.settings.fields', ['setting', $setting])
                        @endforeach
                        <div class="form-group col-sm-12">
                            {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-dark">@lang('crud.cancel')</a>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection