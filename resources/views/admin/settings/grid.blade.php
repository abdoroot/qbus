@foreach($groups as $group)
<div class="col-lg-4 col-sm-6">
    <div class="card card-body">
        <div class="row align-items-center">
            <div class="col-md-4 col-lg-3 text-center">
                <a href="{{ route('admin.settings.show', $group['name']) }}"><i class="icon-settings icon-large"></i></a>
            </div>
            <div class="col-md-8 col-lg-9">
                <h3 class="box-title m-b-0"><a href="{{ route('admin.settings.show', $group['name']) }}">{{ $group['name'] }}</a></h3><small>{{ $group['count'] }} total settings</small>
                <address>{{ $group['description'] }}</address>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- <div class="col-lg-4 col-sm-6">
    <div class="card card-body">
        <div class="row align-items-center">
            <div class="col-md-4 col-lg-3 text-center">
                <a href="{{ route('admin.settings.show', 'no-group') }}"><i class="icon-settings icon-large"></i></a>
            </div>
            <div class="col-md-8 col-lg-9">
                <h3 class="box-title m-b-0"><a href="{{ route('admin.settings.show', 'no-group') }}">More</a></h3><small></small>
                <address>Check more non-grouped settings.</address>
            </div>
        </div>
    </div>
</div> --}}
<div class="col-sm-12 mt-3">
    <div class="float-right">
        <a class="btn btn-primary" href="{{ route('admin.settings.index', ['view' => 'table']) }}">{{ __('All settings') }} <i class="fa fa-arrow-right"></i></a>
    </div>
</div>