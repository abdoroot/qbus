<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Repositories\FeatureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FeatureController extends AppBaseController
{
    /** @var FeatureRepository $featureRepository*/
    private $featureRepository;

    public function __construct(FeatureRepository $featureRepo)
    {
        $this->featureRepository = $featureRepo;
    }

    /**
     * Display a listing of the Feature.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $features = $this->featureRepository->all($request->all());

        return view('admin.features.index')
            ->with('features', $features);
    }

    /**
     * Show the form for creating a new Feature.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created Feature in storage.
     *
     * @param CreateFeatureRequest $request
     *
     * @return Response
     */
    public function store(CreateFeatureRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/features'), $filename);
                $input['icon'] = $filename;
            }
        }

        $feature = $this->featureRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/features.singular')]));
        return redirect(route('admin.features.index'));
    }

    /**
     * Display the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));
            return redirect(route('admin.features.index'));
        }

        return view('admin.features.show')->with('feature', $feature);
    }

    /**
     * Show the form for editing the specified Feature.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));
            return redirect(route('admin.features.index'));
        }

        return view('admin.features.edit')->with('feature', $feature);
    }

    /**
     * Update the specified Feature in storage.
     *
     * @param int $id
     * @param UpdateFeatureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeatureRequest $request)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));
            return redirect(route('admin.features.index'));
        }

        $input = $request->all();

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/features'), $filename);
                $input['icon'] = $filename;
            }
        }
        
        $feature = $this->featureRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/features.singular')]));
        return redirect(route('admin.features.index'));
    }

    /**
     * Remove the specified Feature from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feature = $this->featureRepository->find($id);

        if (empty($feature)) {
            Flash::error(__('messages.not_found', ['model' => __('models/features.singular')]));
            return redirect(route('admin.features.index'));
        }

        $this->featureRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/features.singular')]));
        return redirect(route('admin.features.index'));
    }
}
