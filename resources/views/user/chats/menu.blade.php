
<div class="flex flex-col justify-between flex-1">
    <nav>
        @foreach($chats as $chat)
        <a class="@if($chat_id == $chat->id) bg-gray-200  @endif flex items-center px-4 py-5 text-gray-600 border-b-2" 
            href="{{route('chats.create', ['chat_id' => $chat->id])}}">
            <span class="mx-4">
                {!! $chat->last_message !!}
            </span>
        </a>
        @endforeach
    </nav>
</div>
