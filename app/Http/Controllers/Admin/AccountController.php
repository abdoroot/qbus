<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Provider;
use Flash;
use Response;

class AccountController extends AppBaseController
{
    /** @var AccountRepository $accountRepository*/
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accounts = $this->accountRepository->all($request->all());
        $providers = Provider::pluck('name', 'id')->toArray();

        return view('admin.accounts.index')
            ->with('accounts', $accounts)
            ->with('providers', $providers);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('admin.accounts.create')
            ->with('back_to', $request->back_to)
            ->with('provider_id', $request->provider_id);
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/accounts.singular')]));
        return redirect($request->back_to);
    }

    /**
     * Display the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Request $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect($request->back_to);
        }

        return view('admin.accounts.show')
            ->with('account', $account)
            ->with('back_to', $request->back_to);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect($request->back_to);
        }

        return view('admin.accounts.edit')
            ->with('account', $account)
            ->with('back_to', $request->back_to);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param int $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect($request->back_to);
        }

        $input = $request->except('password');
        if(!is_null($request->password)) $input['password'] = Hash::make($request->password);
        
        $account = $this->accountRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/accounts.singular')]));
        return redirect($request->back_to);
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->find($id);

        if (empty($account)) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect($request->back_to);
        }

        $this->accountRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/accounts.singular')]));
        return redirect($request->back_to);
    }
}
