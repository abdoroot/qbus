@extends('provider.layouts.app')

@section('title', __('crud.show') . ' ' . __('models/reviews.singular'))

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('provider.reviews.index') }}">@lang('models/reviews.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('top-buttons')
<a href="javascript:;" class="btn btn-info m-l-15" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-edit"></i> @lang('crud.edit')</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('provider.reviews.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('provider.reviews.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>

    @include('provider.reviews.edit_modal')  
@endsection