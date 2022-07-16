<?php

namespace App\Http\Controllers\API;

use App\Repositories\ChatRepository;
use App\Repositories\MessageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Provider;
use Flash;
use Response;
use Auth;
use DB;
use Carbon\Carbon;

class ChatAPIController extends AppBaseController
{
    /** @var ChatRepository $chatRepository*/
    private $chatRepository;

    
    /** @var MessageRepository $messageRepository*/
    private $messageRepository;

    public function __construct(ChatRepository $chatRepo, MessageRepository $messageRepo)
    {
        $this->chatRepository = $chatRepo;
        $this->messageRepository = $messageRepo;

        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;
            return $next($request);
        });
    }

    /**
     * Display a listing of the Chat.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $limit = 6;

        $chats = Chat::where('user_id', $this->id)
            ->orderBy('id', 'desc')
            ->get();
            // ->paginate($limit);

        return $this->sendResponse(
            $chats->toArray(),
            __('messages.retrieved', ['model' => __('models/chats.plural')])
        );
    }

    /**
     * Show the form for creating a new Chat.
     *
     * @return Response
     */
    public function show(Request $request)
    {
        $chat = Chat::find($request->chat_id);

        if (is_null($chat)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/chats.singular')])
            );
        }

        $read = Message::where(['chat_id' => $chat->id, 'sender' => 'provider'])->update(['read_at' => Carbon::now()]);

        $chat->provider = $chat->provider;
        $chat->messages = $chat->messages;


        return $this->sendResponse(
            $chat->toArray(),
            __('messages.retrieved', ['model' => __('models/categories.singular')])
        );
    }

    /**
     * Store a newly created Chat in storage.
     *
     * @param CreateChatRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        if(is_null($chat = Chat::find($request->chat_id))) {
            $v = Validator::make($request->all(), Chat::$rules); // provider_id, message, chat_id
            if ($v->fails())
            {
                return $this->sendError(implode(' ', $v->errors()));
            }
            
            $input = $request->except('message');
            $input['user_id'] = $this->id;

            $chat = $this->chatRepository->create($input);
        }
        
        $input = [
            'chat_id' => $chat->id,
            'sender' => 'user',
            'message' => $request->message,
        ];

        $message = $this->messageRepository->create($input);
        $message->chat = $chat;

        DB::commit();

        return $this->sendResponse(
            $message->toArray(),
            __('messages.saved', ['model' => __('models/chats.singular')])
        );
    }

}
