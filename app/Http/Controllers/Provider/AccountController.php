<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Flash;
use Hash;
use Response;
use Auth;

class AccountController extends AppBaseController
{
    /** @var AccountRepository $accountRepository*/
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;

        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
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
        $accounts = $this->accountRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        return view('provider.accounts.index')
            ->with('accounts', $accounts);
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('provider.accounts.create');
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
        $input['provider_id'] = $this->provider_id;
        $input['password'] = Hash::make($request->password);
        $account = $this->accountRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/accounts.singular')]));
        return redirect(route('provider.accounts.index'));
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

        if (empty($account) || $account->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect(route('provider.accounts.index'));
        }

        return view('provider.accounts.show')
            ->with('account', $account);
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

        if (empty($account) || $account->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect(route('provider.accounts.index'));
        }

        return view('provider.accounts.edit')
            ->with('account', $account);
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

        if (empty($account) || $account->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect(route('provider.accounts.index'));
        }

        $input = $request->except('password', 'provider_id');
        if(!is_null($request->password)) $input['password'] = Hash::make($request->password);
        
        $account = $this->accountRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/accounts.singular')]));
        return redirect(route('provider.accounts.index'));
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

        if (empty($account) || $account->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/accounts.singular')]));
            return redirect(route('provider.accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/accounts.singular')]));
        return redirect(route('provider.accounts.index'));
    }
}
