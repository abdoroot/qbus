<div class="row">
    <div class="col-12">
        <div class="card m-b-0">
            <!-- .chat-row -->
            <div class="chat-main-box">
                <!-- .chat-left-panel -->
                <div class="chat-left-aside">
                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                    <div class="chat-left-inner">
                        <div class="form-material">
                            <input class="form-control p-2" type="text" placeholder="Search Contact">
                        </div>
                        <ul class="chatonline style-none ">
                            @foreach($chats as $menuChat)
                            <li @if(isset($chat) && $chat->id == $menuChat->id) class="bg-secondary" @endif>
                                <a href="{{ route('provider.chats.create', ['chat_id' => $menuChat->id]) }}">
                                    <span>
                                        {{ !is_null($user = $menuChat->user) ? $user->name : '-' }} 
                                        <small class="text-success">
                                            @if(!is_null($trip = $menuChat->trip))
                                            @lang('models/trips.singular') {{ $trip->name }}
                                            @elseif(!is_null($package = $menuChat->package))
                                            @lang('models/packages.singular') {{ $package->name }}
                                            @elseif(!is_null($busOrder = $menuChat->busOrder))
                                            @lang('models/busOrders.singular') {{ $busOrder->id }}
                                            @endif
                                        </small>
                                        {{-- <p>{!! $menuChat->last_message !!}</p> --}}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                            <li class="p-20"></li>
                        </ul>
                    </div>
                </div>
                <!-- .chat-left-panel -->
                <!-- .chat-right-panel -->
                <div class="chat-right-aside">
                    <div class="chat-main-header">
                        <div class="p-3 b-b">
                            <h4 class="box-title">
                                @if(!isset($chat)) @lang('msg.please_select_a_chat') 
                                @elseif(!is_null($user = $chat->user)) {{ $user->name }}
                                @else @lang('models/chats.singular') {{ $chat->id }}
                                @endif
                            </h4>
                        </div>
                    </div>
                    @if(isset($chat))
                    <div class="chat-rbox">
                        <ul class="chat-list p-3">
                            @foreach($messages as $message)
                            <li class="{{ $message->sender == 'provider' ? 'reverse' : null }}">
                                <div class="chat-content">
                                    <h5>
                                        @if($message->sender == 'provider' && !is_null($provider = $chat->provider))
                                        {{ $provider->name }}
                                        @elseif($message->sender == 'user' && !is_null($user = $chat->user))
                                        {{ $user->name }}
                                        @else
                                        -
                                        @endif
                                    </h5>
                                    <div class="box bg-light-inverse">{{ $message->message }}</div>
                                    <div class="chat-time">{{ Carbon\Carbon::parse($message->created_at)->format('d M h:i a') }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body border-top">
                        {!! Form::open(['route' => 'provider.chats.store', 'class' => 'row']) !!}
                            {!! Form::hidden('chat_id', $chat->id) !!}
                            <div class="col-8">
                                <textarea name="message" placeholder="@lang('msg.type_your_message_here')" class="form-control border-0"></textarea>
                            </div>
                            <div class="col-4 text-right">
                                <button type="submit" class="btn btn-info btn-circle btn-lg"><i class="fas fa-paper-plane"></i> </button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </div>
                <!-- .chat-right-panel -->
            </div>
            <!-- /.chat-row -->
        </div>

        {!! $chats->links('vendor.pagination.bootstrap-4') !!}
    </div>
</div>