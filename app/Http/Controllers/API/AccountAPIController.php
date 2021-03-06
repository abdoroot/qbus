<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAccountAPIRequest;
use App\Http\Requests\API\UpdateAccountAPIRequest;
use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AccountController
 * @package App\Http\Controllers\API
 */

class AccountAPIController extends AppBaseController
{
    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     * GET|HEAD /accounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $accounts->toArray(),
            __('messages.retrieved', ['model' => __('models/accounts.plural')])
        );
    }

    /**
     * Store a newly created Account in storage.
     * POST /accounts
     *
     * @param CreateAccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountAPIRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        return $this->sendResponse(
            $account->toArray(),
            __('messages.saved', ['model' => __('models/accounts.singular')])
        );
    }

    /**
     * Display the specified Account.
     * GET|HEAD /accounts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accounts.singular')])
            );
        }

        return $this->sendResponse(
            $account->toArray(),
            __('messages.retrieved', ['model' => __('models/accounts.singular')])
        );
    }

    /**
     * Update the specified Account in storage.
     * PUT/PATCH /accounts/{id}
     *
     * @param int $id
     * @param UpdateAccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accounts.singular')])
            );
        }

        $account = $this->accountRepository->update($input, $id);

        return $this->sendResponse(
            $account->toArray(),
            __('messages.updated', ['model' => __('models/accounts.singular')])
        );
    }

    /**
     * Remove the specified Account from storage.
     * DELETE /accounts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Account $account */
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/accounts.singular')])
            );
        }

        $account->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/accounts.singular')])
        );
    }
}
