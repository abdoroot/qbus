<div class="table-responsive">
    <table class="table table-bordered" id="settings-table">
        <thead>
            <th>@lang('models/settings.fields.key')</th>
            <th>@lang('models/settings.fields.value')</th>
            <th>@lang('crud.action')</th>
        </thead>
        <tbody>
            @foreach($settings as $setting)
            <tr>
                <td>@lang('models/settings.keys.'.$setting->key)</td>
                <td>{{ $setting->value }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('admin.settings.show', [$setting->id]) }}" class='btn btn-primary btn-sm'>
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
