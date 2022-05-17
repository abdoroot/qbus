<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmailAPIRequest;
use App\Http\Requests\API\UpdateEmailAPIRequest;
use App\Models\Email;
use App\Repositories\EmailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EmailController
 * @package App\Http\Controllers\API
 */

class EmailAPIController extends AppBaseController
{
    /** @var  EmailRepository */
    private $emailRepository;

    public function __construct(EmailRepository $emailRepo)
    {
        $this->emailRepository = $emailRepo;
    }

    /**
     * Display a listing of the Email.
     * GET|HEAD /emails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $emails = $this->emailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $emails->toArray(),
            __('messages.retrieved', ['model' => __('models/emails.plural')])
        );
    }

    /**
     * Store a newly created Email in storage.
     * POST /emails
     *
     * @param CreateEmailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailAPIRequest $request)
    {
        $input = $request->all();

        $email = $this->emailRepository->create($input);

        return $this->sendResponse(
            $email->toArray(),
            __('messages.saved', ['model' => __('models/emails.singular')])
        );
    }

    /**
     * Display the specified Email.
     * GET|HEAD /emails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Email $email */
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/emails.singular')])
            );
        }

        return $this->sendResponse(
            $email->toArray(),
            __('messages.retrieved', ['model' => __('models/emails.singular')])
        );
    }

    /**
     * Update the specified Email in storage.
     * PUT/PATCH /emails/{id}
     *
     * @param int $id
     * @param UpdateEmailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailAPIRequest $request)
    {
        $input = $request->all();

        /** @var Email $email */
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/emails.singular')])
            );
        }

        $email = $this->emailRepository->update($input, $id);

        return $this->sendResponse(
            $email->toArray(),
            __('messages.updated', ['model' => __('models/emails.singular')])
        );
    }

    /**
     * Remove the specified Email from storage.
     * DELETE /emails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Email $email */
        $email = $this->emailRepository->find($id);

        if (empty($email)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/emails.singular')])
            );
        }

        $email->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/emails.singular')])
        );
    }
}
