<h1 class="text-2xl">
    @lang('models/chats.fields.provider_id') : {{ !is_null($provider) ? $provider->name : '-' }}
</h1>

@include('guest.layouts.flash')

<div style="overscroll-behavior: none;">
    <div class="mt-20 mb-16">
        @foreach($messages as $message)
        <div class="clearfix">
            <div class="bg-{{ $message->sender == 'user' ? 'gray-300' : 'purple-300 float-right' }} w-3/4 mx-4 my-2 p-2 rounded-lg">
                {{ $message->message }}
            </div>
        </div>
        @endforeach
    </div>
</div>

{!! Form::open(['route' => 'chats.store', 'class' => 'relative w-full flex justify-between bg-purple-100', 'style' => 'bottom: 0px;']) !!}
    {!! Form::hidden('chat_id', $chat_id) !!}
    {!! Form::hidden('provider_id', $provider_id) !!}
    {!! Form::hidden('trip_id', $trip_id) !!}
    {!! Form::hidden('package_id', $package_id) !!}
    {!! Form::hidden('bus_id', $bus_id) !!}
    {!! Form::hidden('trip_order_id', $trip_order_id) !!}
    {!! Form::hidden('package_order_id', $package_order_id) !!}
    {!! Form::hidden('bus_order_id', $bus_order_id) !!}
    <textarea class="flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 bg-gray-200 resize-none" 
        rows="1"
        name="message"
        placeholder="@lang('models/messages.fields.message') ..." style="outline: none;"></textarea>
    <button class="m-2" style="outline: none;">
        <svg class="svg-inline--fa text-purple-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2" aria-hidden="true"
            focusable="false" data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512">
            <path fill="currentColor"
                d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z" />
        </svg>
    </button>
{!! Form::close() !!}
