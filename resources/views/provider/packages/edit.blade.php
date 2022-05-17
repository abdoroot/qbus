@extends('provider.layouts.app')

@section('title', __('crud.edit') . ' ' . __('models/packages.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.packages.index') }}">@lang('models/packages.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.edit')</li>
@endsection

@section('content')
    <div class="row">
        @include('flash::message')
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($package, ['route' => ['provider.packages.update', $package->id], 'method' => 'patch', 'files' => 'on']) !!}
                        @include('provider.packages.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection