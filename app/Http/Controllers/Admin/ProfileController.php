<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdminRequest;
use App\Repositories\AdminRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin;
use Validator;
use Flash;
use Auth;
use Hash;
use App;
use DB;

class ProfileController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /** @var  AdminRepository */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.index')
            ->with('admin', $admin)
            ->with('active', $request->active);
    }

    public function update(UpdateAdminRequest $request)
    {
        $input = $request->only(['name', 'email']);
        $admin = Auth::guard('admin')->user();

        $admin = $this->adminRepository->update($input, $admin->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.profile')]));
        return redirect(route('admin.profile.index', ['active' => 'settings']));
    }

    public function password(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:8|max:255|confirmed'
        ];

        if(!Hash::check($request->current_password, $admin->password)) {
            $error = trans('passwords.dismatch');
            return redirect()->back()->withInput()->withErrors(['current_password' => $error]);
        }

        $input = ['password' => Hash::make($request->password)];

        $request->validate($rules);

        $admin = $this->adminRepository->update($input, $admin->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.password')]));
        return redirect(route('admin.profile.index', ['active' => 'password']));
    }
}
