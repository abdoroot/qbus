@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/additionals.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.additionals.index') }}">@lang('models/additionals.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="{{ route('admin.additionals.edit', $additional->id) }}" class="btn btn-info m-l-15"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.additionals.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('admin.additionals.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection