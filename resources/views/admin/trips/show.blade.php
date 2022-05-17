@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/trips.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.trips.index') }}">@lang('models/trips.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.trips.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('admin.trips.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection