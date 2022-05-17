<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\CreateContactRequest;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use Flash;
use Response;
use Mail;
use DB;
use Auth;

class ContactController extends AppBaseController
{
    /** @var ContactRepository $contactRepository*/
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;

        $this->middleware(function ($request, $next) {
            $this->id = Auth::check() ? Auth::user()->id : null;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Contact.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contacts = $this->contactRepository->all(['user_id' => $this->id]);

        return view('user.contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if($request->type == 'complaint' && !is_null($this->id)) {
            return view('user.contacts.create')->with('type', $request->type);
        }

        return view('guest.contact');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = $this->id;
        $input['type'] = in_array($request->type, ['contact', 'complaint', 'feedback']) ? $request->type : 'contact';

        $contact = $this->contactRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/contacts.singular')]));

        // if(!is_null($this->id)) {
        //     return redirect()->route('contacts.index');
        // }

        $request->session()->flash($contact->type, __('messages.saved', ['model' => __('models/contacts.types.'.$contact->type)]));
        return redirect()->back();
    }

    /**
     * Display the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact) || $contact->user_id != $this->id) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));
            return redirect(route('contacts.index'));
        }

        return view('user.contacts.show')->with('contact', $contact);
    }
}
