@extends('admin.layouts.app')

@section('title', __('models/contacts.plural'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('models/contacts.plural')</li>
@endsection

{{--@section('top-buttons')--}}
{{--<a href="{{ route('admin.contacts.create') }}" class="btn btn-info"><i class="fa fa-plus-circle"></i> @lang('crud.add_new')</a>--}}
{{--@endsection--}}

@section('content')
<div class="row">
    @include('flash::message')
    <div class="card col-sm-12">
        <div class="card-body p-0">
            <div class="row m-t-40">
                @foreach($statistics as $statistic)
                <!-- Column -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card">
                        <div class="box bg-{{ $statistic->bg_type }} text-center">
                            <h1 class="font-light text-white">{{ $statistic->number }}</h1>
                            <h6 class="text-white">{{ $statistic->name }}</h6>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @include('admin.contacts.table')
        </div>
    </div>
</div>

@endsection
