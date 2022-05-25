<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEmailRequest;
use App\Models\Setting;
use App\Models\Feature;
use App\Models\Service;
use App\Models\Email;
use App\Models\Trip;
use App\Models\Package;
use App\Models\Coupon;
use App\Models\City;
use Carbon\Carbon;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header_image = Setting::values('header_image');
        if(!is_null($header_image)) {
            $header_image = asset('images/settings/'.$header_image);
        } else {
            $header_image = asset('design/assets/img/20.jpg');
        }

        $section_title = Setting::values('section_title');
        $section_text = Setting::values('section_text');
        $section_link = Setting::values('section_link');

        $cities = City::pluck('name', 'id');

        return view('user.home.index')
            ->with('header_image', $header_image)
            ->with('section_title', $section_title)
            ->with('section_text', $section_text)
            ->with('section_link', $section_link)
            ->with('cities', $cities);
    }

    public function setLocale($locale) {
        Session::put('locale', $locale);
        return redirect()->back();   
    }

    public function about()
    {
        $about_title = Setting::values('about_title');    
        $about_subtitle = Setting::values('about_subtitle');
        $about_text = Setting::values('about_text');
        $about_image = Setting::values('about_image');
        if(!is_null($about_image)) $about_image = asset('images/settings/'.$about_image);
        $features_title = Setting::values('features_title');

        $features = Feature::get();

        return view('guest.about')
            ->with('about_title', $about_title)
            ->with('about_subtitle', $about_subtitle)
            ->with('about_text', $about_text)
            ->with('about_image', $about_image)
            ->with('features_title', $features_title)
            ->with('features', $features);
    }

    public function services()
    {
        $services_title = Setting::values('services_title');    
        $services_subtitle = Setting::values('services_subtitle');
        $services = Service::get();

        return view('guest.services')
            ->with('services_title', $services_title)
            ->with('services_subtitle', $services_subtitle)
            ->with('services', $services);
    }

    public function contact()
    {
        $contact_title = Setting::values('contact_title');    
        $contact_subtitle = Setting::values('contact_subtitle');

        return view('guest.contact')
            ->with('contact_title', $contact_title)
            ->with('contact_subtitle', $contact_subtitle);
    }

    public function email(CreateEmailRequest $request)
    {
        $email = Email::create(['email' => $request->email]);

        $request->session()->flash('email', __('messages.saved', ['model' => __('models/emails.singular')]));
        return redirect()->back();
    }

    public function code(Request $request)
    {
        $query = '';
        $paginator = null;
        if(!is_null($code = $request->code)) {
            $limit = 6;
            $today = Carbon::now();
            $query = "&code={$request->code}";
            $provider_id = null;
            $coupon = Coupon::where(['code' => $request->code, 'status' => 'approved'])
                ->where('date_from', '<=', $today->toDateString())
                ->where('date_to', '>=', $today->toDateString())
                ->first();
            if(!is_null($coupon)) $provider_id = $coupon->provider_id;

            $trips = Trip::where(function ($query) use ($today) {
                    $query->where('date_to', '>', $today->toDateString())
                        ->orWhere(function ($query) use ($today)
                        {
                            $query->where('date_to', '=', $today->toDateString())
                                ->where('time_from', '>=', $today->toTimeString());
                        });
                })
                ->join('providers', 'providers.id', '=', 'trips.provider_id')
                ->where('provider_id', $provider_id)
                ->select('trips.*')
                ->orderBy('date_from', 'asc')
                ->get();

            $packages = Package::join('providers', 'providers.id', '=', 'packages.provider_id')
                ->where('provider_id', $provider_id)
                ->select('packages.*')
                ->orderBy('date_from', 'asc')
                ->get();

            $paginator = $trips->merge($packages)->sortBy('date_from')->paginate($limit);
        }
        
        return view('user.code')
            ->with('query', $query)
            ->with('code', $code)
            ->with('paginator', $paginator);
    }
}
