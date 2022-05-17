<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\TerminalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TerminalController extends AppBaseController
{
    /** @var TerminalRepository $terminalRepository*/
    private $terminalRepository;

    public function __construct(TerminalRepository $terminalRepo)
    {
        $this->terminalRepository = $terminalRepo;
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
        $terminals = $this->terminalRepository->all($request->all());

        return view('admin.terminals.index')
            ->with('terminals', $terminals);
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

        if (empty($terminal)) {
            Flash::error(__('messages.not_found', ['model' => __('models/terminals.singular')]));
            return redirect(route('admin.terminals.index'));
        }

        return view('admin.terminals.show')->with('terminal', $terminal);
    }
}
