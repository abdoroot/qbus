@extends('user.layouts.app')

@section('title', __('msg.contact') . ': ' . $contact->subject)

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('contacts.index') }}">@lang('models/contacts.plural')</a></li>
<li class="breadcrumb-item active">@lang('crud.show')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tbody>
                            @include('user.contacts.show_fields')
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a class="btn btn-dark" href="{{ route('contacts.index') }}">@lang('crud.back')</a>
                </div>
            </div>
        </div>
    </div>
@endsection