<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreateTerminalRequest;
use App\Http\Requests\UpdateTerminalRequest;
use App\Repositories\TerminalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;

class TerminalController extends AppBaseController
{
    /** @var TerminalRepository $terminalRepository*/
    private $terminalRepository;

    public function __construct(TerminalRepository $terminalRepo)
    {
        $this->terminalRepository = $terminalRepo;
        
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Terminal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $terminals = $this->terminalRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        return view('provider.terminals.index')
            ->with('terminals', $terminals);
    }

    /**
     * Show the form for creating a new Terminal.
     *
     * @return Response
     */
    public function create()
    {
        return view('provider.terminals.create');
    }

    /**
     * Store a newly created Terminal in storage.
     *
     * @param CreateTerminalRequest $request
     *
     * @return Response
     */
    public function store(CreateTerminalRequest $request)
    {
        $input = $request->only('name');
        $input['provider_id'] = $this->provider_id;
        $terminal = $this->terminalRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/terminals.singular')]));
        return redirect(route('provider.terminals.index'));
    }

    /**
     * Display the specified Terminal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal) || $terminal->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/terminals.singular')]));
            return redirect(route('provider.terminals.index'));
        }

        return view('provider.terminals.show')->with('terminal', $terminal);
    }

    /**
     * Show the form for editing the specified Terminal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal) || $terminal->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/terminals.singular')]));
            return redirect(route('provider.terminals.index'));
        }

        return view('provider.terminals.edit')->with('terminal', $terminal);
    }

    /**
     * Update the specified Terminal in storage.
     *
     * @param int $id
     * @param UpdateTerminalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTerminalRequest $request)
    {
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal) || $terminal->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/terminals.singular')]));
            return redirect(route('provider.terminals.index'));
        }

        $input = $request->only('name');
        $terminal = $this->terminalRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/terminals.singular')]));
        return redirect(route('provider.terminals.index'));
    }

    /**
     * Remove the specified Terminal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal) || $terminal->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/terminals.singular')]));
            return redirect(route('provider.terminals.index'));
        }

        $this->terminalRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/terminals.singular')]));
        return redirect(route('provider.terminals.index'));
    }
}
