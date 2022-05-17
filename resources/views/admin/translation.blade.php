@extends('admin.layouts.app')

@section('title', __('msg.translation'))

@section('breadcrumb')
<li class="breadcrumb-item active">@lang('msg.translation')</li>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <iframe src="{{ url('/admin/translations') }}"></iframe>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection

@push('page_css') 
<style>
    iframe {
        width: 100%;
        height: calc(100vh - 20em);
        border: none;
    }
</style>
@endpush