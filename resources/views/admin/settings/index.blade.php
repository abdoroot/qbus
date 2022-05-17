@extends('admin.layouts.app')

@section('title', __('models/settings.plural'))

@push('page_css')
<style>
    i.icon-large {
        font-size: 40px;
    }
    .card.card-body {
        min-height: 146px;
    }
</style>
@endpush

@section('content')
<div class="row">
    @include('flash::message')
    @if($view == 'grid')
        @include('admin.settings.grid')
    @else
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                @include('admin.settings.table')
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('page_scripts')
<!-- This is data table -->
<script src="{{ asset('elite//assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('elite//assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
<script>
    $('#settings-table').DataTable({
        responsive: true
    });
</script>
@endpush