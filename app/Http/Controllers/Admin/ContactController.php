<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Repositories\ContactRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Contact;
use Carbon\Carbon;
use Flash;
use Response;
use Mail;
use DB;

class ContactController extends AppBaseController
{
    /** @var ContactRepository $contactRepository*/
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
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
        $contacts = $this->contactRepository->all($request->all());

        $statistics = [
            (object)[
                'name' => __('models/contacts.unread'),
                'number' => Contact::where('read_at', null)->count(),
                'bg_type' => 'info'
            ],
            (object)[
                'name' => __('models/contacts.unreplied'),
                'number' => Contact::where('reply_message', null)->count(),
                'bg_type' => 'primary'
            ],
            (object)[
                'name' => __('models/contacts.replied'),
                'number' => Contact::where('reply_message', '!=', null)->count(),
                'bg_type' => 'success'
            ],
            (object)[
                'name' => __('crud.all'),
                'number' => Contact::count(),
                'bg_type' => 'dark'
            ]
        ];

        return view('admin.contacts.index')
            ->with('contacts', $contacts)
            ->with('statistics', $statistics);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.contacts.create');
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

        DB::beginTransaction();

        $contact = $this->contactRepository->create($input);

        if(!is_null($request->reply_message)) {
            Mail::send('emails.message', [
                'text' => $request->reply_message
            ], function ($message) use ($contact) {
                $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                $message->to($contact->email, $contact->name);
                $message->subject($contact->subject);
                $message->priority(1);
            });
        }

        DB::commit();

        Flash::success(__('messages.saved', ['model' => __('models/contacts.singular')]));
        return redirect(route('admin.contacts.index'));
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

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));
            return redirect(route('admin.contacts.index'));
        }

        if(is_null($contact->read_at)) {
            $contact = $this->contactRepository->update(['read_at' => Carbon::now()], $id);
        }

        return view('admin.contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));
            return redirect(route('admin.contacts.index'));
        }

        return view('admin.contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param int $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));
            return redirect(route('admin.contacts.index'));
        }

        $input = $request->all();

        DB::beginTransaction();

        $contact = $this->contactRepository->update($input, $id);

        if(!is_null($request->reply_message)) {
            Mail::send('emails.message', [
                'text' => $request->reply_message
            ], function ($message) use ($contact) {
                $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'));
                $message->to($contact->email, $contact->name);
                $message->subject($contact->subject);
                $message->priority(1);
            });

            if(!is_null($contact->user_id) || !is_null($contact->account_id)) {
                Notification::create([
                    'title' => $contact->subject,
                    'text' => substr(strip_tags($contact->reply_message), 0, 200),
                    'url' => route('contacts.show', $contact->id),
                    'icon' => 'icon-info',
                    'type' => 'info',
                    'to' => !is_null($contact->user_id) ? 'user' : 'provider',
                    'user_id' => $contact->user_id,
                    'provider_id' => $contact->provider_id,
                    'account_id' => $contact->account_id,
                ]);
            }
        }

        DB::commit();

        Flash::success(__('messages.updated', ['model' => __('models/contacts.singular')]));
        return redirect(route('admin.contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error(__('messages.not_found', ['model' => __('models/contacts.singular')]));
            return redirect(route('admin.contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/contacts.singular')]));
        return redirect(route('admin.contacts.index'));
    }
}
