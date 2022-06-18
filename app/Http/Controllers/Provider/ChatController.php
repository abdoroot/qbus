<?php

namespace App\Http\Controllers\Provider;

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

class ChatController extends AppBaseController
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
            $this->provider_id = Auth::guard('provider')->check() ? Auth::guard('provider')->user()->provider_id : null;
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
        $limit = 6;

        $chats = Chat::where('provider_id', $this->provider_id)
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return view('provider.chats.index')
            ->with('chats', $chats);
    }

    /**
     * Show the form for creating a new Chat.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $chat = Chat::find($request->chat_id);

        $provider = (!is_null($chat) ? $chat->provider : Provider::find($request->provider_id));

        $messages = (!is_null($chat) ? $chat->messages : []);

        $chats = Chat::where('provider_id', $this->provider_id)->orderBy('updated_at', 'desc')->get();

        return view('provider.chats.create')
            ->with('provider', $provider)
            ->with('provider_id', !is_null($provider) ? $provider->id : null)
            ->with('chat_id', $request->chat_id)
            ->with('chat', $chat)
            ->with('messages', $messages)
            ->with('chats', $chats);
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
            $this->validate($request, Chat::$rules);
            
            $input = $request->except('message');
            $input['provider_id'] = $this->provider_id;

            $chat = $this->chatRepository->create($input);
        }
        
        $input = [
            'chat_id' => $chat->id,
            'sender' => 'provider',
            'message' => $request->message,
        ];

        $message = $this->messageRepository->create($input);

        DB::commit();

        // Flash::success(__('messages.sent', ['model' => __('models/messages.singular')]));
        return redirect()->route('provider.chats.create', ['chat_id' => $chat->id]);
    }

}
