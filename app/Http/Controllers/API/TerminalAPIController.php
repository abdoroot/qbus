<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTerminalAPIRequest;
use App\Http\Requests\API\UpdateTerminalAPIRequest;
use App\Models\Terminal;
use App\Repositories\TerminalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TerminalController
 * @package App\Http\Controllers\API
 */

class TerminalAPIController extends AppBaseController
{
    /** @var  TerminalRepository */
    private $terminalRepository;

    public function __construct(TerminalRepository $terminalRepo)
    {
        $this->terminalRepository = $terminalRepo;
    }

    /**
     * Display a listing of the Terminal.
     * GET|HEAD /terminals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $terminals = $this->terminalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $terminals->toArray(),
            __('messages.retrieved', ['model' => __('models/terminals.plural')])
        );
    }

    /**
     * Store a newly created Terminal in storage.
     * POST /terminals
     *
     * @param CreateTerminalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTerminalAPIRequest $request)
    {
        $input = $request->all();

        $terminal = $this->terminalRepository->create($input);

        return $this->sendResponse(
            $terminal->toArray(),
            __('messages.saved', ['model' => __('models/terminals.singular')])
        );
    }

    /**
     * Display the specified Terminal.
     * GET|HEAD /terminals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Terminal $terminal */
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/terminals.singular')])
            );
        }

        return $this->sendResponse(
            $terminal->toArray(),
            __('messages.retrieved', ['model' => __('models/terminals.singular')])
        );
    }

    /**
     * Update the specified Terminal in storage.
     * PUT/PATCH /terminals/{id}
     *
     * @param int $id
     * @param UpdateTerminalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTerminalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Terminal $terminal */
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/terminals.singular')])
            );
        }

        $terminal = $this->terminalRepository->update($input, $id);

        return $this->sendResponse(
            $terminal->toArray(),
            __('messages.updated', ['model' => __('models/terminals.singular')])
        );
    }

    /**
     * Remove the specified Terminal from storage.
     * DELETE /terminals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Terminal $terminal */
        $terminal = $this->terminalRepository->find($id);

        if (empty($terminal)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/terminals.singular')])
            );
        }

        $terminal->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/terminals.singular')])
        );
    }
}
