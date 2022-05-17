<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Repositories\ServiceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ServiceController extends AppBaseController
{
    /** @var ServiceRepository $serviceRepository*/
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the Service.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $services = $this->serviceRepository->all($request->all());

        return view('admin.services.index')
            ->with('services', $services);
    }

    /**
     * Show the form for creating a new Service.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created Service in storage.
     *
     * @param CreateServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/services'), $filename);
                $input['image'] = $filename;
            }
        }

        $service = $this->serviceRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/services.singular')]));
        return redirect(route('admin.services.index'));
    }

    /**
     * Display the specified Service.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('messages.not_found', ['model' => __('models/services.singular')]));
            return redirect(route('admin.services.index'));
        }

        return view('admin.services.show')->with('service', $service);
    }

    /**
     * Show the form for editing the specified Service.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('messages.not_found', ['model' => __('models/services.singular')]));
            return redirect(route('admin.services.index'));
        }

        return view('admin.services.edit')->with('service', $service);
    }

    /**
     * Update the specified Service in storage.
     *
     * @param int $id
     * @param UpdateServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceRequest $request)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('messages.not_found', ['model' => __('models/services.singular')]));
            return redirect(route('admin.services.index'));
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/services'), $filename);
                $input['image'] = $filename;
            }
        }
        
        $service = $this->serviceRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/services.singular')]));
        return redirect(route('admin.services.index'));
    }

    /**
     * Remove the specified Service from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            Flash::error(__('messages.not_found', ['model' => __('models/services.singular')]));
            return redirect(route('admin.services.index'));
        }

        $this->serviceRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/services.singular')]));
        return redirect(route('admin.services.index'));
    }
}
