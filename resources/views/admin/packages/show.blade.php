@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/packages.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">@lang('models/packages.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.packages.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('admin.packages.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection