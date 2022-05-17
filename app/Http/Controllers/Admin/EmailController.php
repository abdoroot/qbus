<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Repositories\EmailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmailController extends AppBaseController
{
    /** @var EmailRepository $emailRepository*/
    private $emailRepository;

    public function __construct(EmailRepository $emailRepo)
    {
        $this->emailRepository = $emailRepo;
    }

    /**
     * Display a listing of the Email.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $emails = $this->emailRepository->all($request->all());

        return view('admin.emails.index')
            ->with('emails', $emails);
    }

    /**
     * Show the form for creating a new Email.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.emails.create');
    }

    /**
     * Store a newly created Email in storage.
     *
     * @param CreateEmailRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailRequest $request)
    {
        $input = $request->all();

        $email = $this->emailRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/emails.singular')]));
        return redirect(route('admin.emails.index'));
    }

    /**
     * Display the specified Email.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error(__('messages.not_found', ['model' => __('models/emails.singular')]));
            return redirect(route('admin.emails.index'));
        }

        return view('admin.emails.show')->with('email', $email);
    }

    /**
     * Show the form for editing the specified Email.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error(__('messages.not_found', ['model' => __('models/emails.singular')]));
            return redirect(route('admin.emails.index'));
        }

        return view('admin.emails.edit')->with('email', $email);
    }

    /**
     * Update the specified Email in storage.
     *
     * @param int $id
     * @param UpdateEmailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailRequest $request)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error(__('messages.not_found', ['model' => __('models/emails.singular')]));
            return redirect(route('admin.emails.index'));
        }

        $input = $request->all();
        $email = $this->emailRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/emails.singular')]));
        return redirect(route('admin.emails.index'));
    }

    /**
     * Remove the specified Email from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            Flash::error(__('messages.not_found', ['model' => __('models/emails.singular')]));
            return redirect(route('admin.emails.index'));
        }

        $this->emailRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/emails.singular')]));
        return redirect(route('admin.emails.index'));
    }
}
