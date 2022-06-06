<?php

namespace App\Http\Controllers\User;

use App\Repositories\ChatRepository;
use App\Http\Requests\CreateChatOrderRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use Flash;
use Response;
use Auth;
use DB;
use Carbon\Carbon;

class ChatController extends AppBaseController
{
    /** @var ChatRepository $chatRepository*/
    private $chatRepository;

    public function __construct(ChatRepository $chatRepo)
    {
        $this->chatRepository = $chatRepo;
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
        $limit = 6;

        $chats = Chat::where('user_id', $this->id)
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return view('user.chats.index')
            ->with('chats', $chats);
    }

    /**
     * Display the specified Chat.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $chat = $this->chatRepository->find($id);
        if (empty($chat) || $chat->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/chats.singular')]));
            return redirect(route('chats.index'));
        }

        return view('user.chats.show')
            ->with('chat', $chat);
    }
}
