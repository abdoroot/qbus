@if (session()->has('message') || session()->has('status'))
    <div class="flex items-center text-base tracking-wide text-xs mt-1 mb-3 px-5 py-5 bg-blue-500">
        {{ session()->get('message') ?? session('status') }}
    </div>
@endif

@foreach (session('flash_notification', collect())->toArray() as $message)
    <div class="flex items-center text-base tracking-wide text-xs mt-1 mb-3 px-5 py-5 bg-{{ $message['level'] == 'success' ? 'green-500' : 'red-500' }}">
        {!! $message['message'] !!}
    </div>
@endforeach

{{ session()->forget('flash_notification') }}