<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAdditionalRequest;
use App\Http\Requests\UpdateAdditionalRequest;
use App\Repositories\AdditionalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AdditionalController extends AppBaseController
{
    /** @var AdditionalRepository $additionalRepository*/
    private $additionalRepository;

    public function __construct(AdditionalRepository $additionalRepo)
    {
        $this->additionalRepository = $additionalRepo;
    }

    /**
     * Display a listing of the Additional.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $additionals = $this->additionalRepository->all($request->all());

        return view('admin.additionals.index')
            ->with('additionals', $additionals);
    }

    /**
     * Show the form for creating a new Additional.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.additionals.create');
    }

    /**
     * Store a newly created Additional in storage.
     *
     * @param CreateAdditionalRequest $request
     *
     * @return Response
     */
    public function store(CreateAdditionalRequest $request)
    {
        $input = $request->all();

        $additional = $this->additionalRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/additionals.singular')]));
        return redirect(route('admin.additionals.index'));
    }

    /**
     * Display the specified Additional.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionals.singular')]));
            return redirect(route('admin.additionals.index'));
        }

        return view('admin.additionals.show')->with('additional', $additional);
    }

    /**
     * Show the form for editing the specified Additional.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionals.singular')]));
            return redirect(route('admin.additionals.index'));
        }

        return view('admin.additionals.edit')->with('additional', $additional);
    }

    /**
     * Update the specified Additional in storage.
     *
     * @param int $id
     * @param UpdateAdditionalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdditionalRequest $request)
    {
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionals.singular')]));
            return redirect(route('admin.additionals.index'));
        }

        $input = $request->all();
        $additional = $this->additionalRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/additionals.singular')]));
        return redirect(route('admin.additionals.index'));
    }

    /**
     * Remove the specified Additional from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $additional = $this->additionalRepository->find($id);

        if (empty($additional)) {
            Flash::error(__('messages.not_found', ['model' => __('models/additionals.singular')]));
            return redirect(route('admin.additionals.index'));
        }

        $this->additionalRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/additionals.singular')]));
        return redirect(route('admin.additionals.index'));
    }
}
