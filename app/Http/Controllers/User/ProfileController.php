<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Contact;
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
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        return view('user.profile.index')
            ->with('user', $user)
            ->with('active', $request->active);
    }

    public function update(UpdateUserRequest $request)
    {
        //$input = $request->only(['name', 'email', 'phone','date_of_birth ','image','address']);
        $input = $request->all();
        //dd($input);
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if($file->isValid()) {
                $filename = time().'_'.substr($file->getClientOriginalName(), -20);
                $file->move(public_path('images/users'), $filename);
                $input['image'] = $filename;
            }
        }

        $user = $this->userRepository->update($input, $user->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.profile')]));
        return redirect(route('profile.index', ['active' => 'settings']));
    }

    public function password(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'current_password' => 'required',
            'password' => 'required|min:8|max:255|confirmed'
        ];

        if(!Hash::check($request->current_password, $user->password)) {
            $error = trans('passwords.dismatch');
            return redirect()->back()->withInput()->withErrors(['current_password' => $error]);
        }

        $input = ['password' => Hash::make($request->password)];

        $request->validate($rules);

        $user = $this->userRepository->update($input, $user->id);

        Flash::success(trans('msg.updated_successfully', ['name' => trans('msg.password')]));
        return redirect(route('profile.index', ['active' => 'password']));
    }

    public function settings(Request $request)
    {
        $user = Auth::user();
        return view('user.profile.settings')
            ->with('user', $user)
            ->with('active', $request->active);
    }


    public function passwordIndex(Request $request)
    {
        $user = Auth::user();
        return view('user.profile.passwordIndex')
            ->with('user', $user)
            ->with('active', $request->active);
    }

    public function complaint(Request $request)
    {
        $user = Auth::user();
        $contacts = $user->contacts()->get();
        //dd(json_decode(json_encode($contacts),true));
        return view('user.profile.complaint')
            ->with('user', $user)
            ->with('contacts', $contacts);
    }

    public function newComplaint(Request $request)
    {
        $user = Auth::user();
        return view('user.profile.new_complaint')->with('user', $user);
    }

    public function showComplaint($id)
    {
        $contact = Contact::find($id);
        //dd($contact->id);
        $user = Auth::user();
        return view('user.profile.show_complaint')
            ->with('user', $user)
            ->with('contact', $contact);
    }

    public function logout()
    {
        Auth::logout();;
        return redirect(route('home'));
    }
}
