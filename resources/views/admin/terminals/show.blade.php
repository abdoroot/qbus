@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/terminals.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.terminals.index') }}">@lang('models/terminals.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.terminals.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('admin.terminals.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection