@extends('admin.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/accounts.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">@lang('models/accounts.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="{{ route('admin.accounts.edit', ['account' => $account->id, 'back_to' => $back_to = (isset($back_to) && !is_null($back_to) ? $back_to : route('admin.accounts.index'))]) }}" class="btn btn-info m-l-15"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('admin.accounts.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ $back_to }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection