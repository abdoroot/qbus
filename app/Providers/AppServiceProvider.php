<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Barryvdh\TranslationManager\Models\Translation;
use App\Models\Setting;

use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {

            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(

                $this->forPage($page, $perPage),

                $total ?: $this->count(),

                $perPage,

                $page,

                [

                    'path' => LengthAwarePaginator::resolveCurrentPath(),

                    'pageName' => $pageName,

                ]

            );

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Set the default locale as the first one.
        $locales = Translation::groupBy('locale')
            ->select('locale')
            ->get()
            ->pluck('locale');

        if ($locales instanceof Collection) {
            $locales = $locales->all();
        }
        $locales = array_merge([config('app.locale')], $locales);
        $locales = array_unique($locales);

        $app_logo = Setting::values('logo');
        if(!is_null($app_logo)) {
            $app_logo = asset('images/settings/'.$app_logo);
        }

        $app_logo_light = Setting::values('logo-light');
        if(!is_null($app_logo_light)) {
            $app_logo_light = asset('images/settings/'.$app_logo_light);
        }

        $app_email = Setting::values('email');
        $app_phone = Setting::values('phone');
        $app_location = Setting::values('location');
        $app_email2 = Setting::values('email2');
        $app_phone2 = Setting::values('phone2');
        $app_copyright = Setting::values('copyright');
        $app_links_title = Setting::values('links_title');
        $app_download_title = Setting::values('download_title');
        $app_contact_title = Setting::values('contact_title');
        $app_provider_title = Setting::values('provider_title');
        $app_provider_subtitle = Setting::values('provider_subtitle');
        $app_email_title = Setting::values('email_title');
        $app_feedback_title = Setting::values('feedback_title');
        $app_feedback_subtitle = Setting::values('feedback_subtitle');
        $app_feedback_footer = Setting::values('feedback_footer');
        $socials = Setting::where('group', 'social')->get();
        $app_store = Setting::values('app-store');
        $google_play = Setting::values('google-play');

        view()->share('locales', $locales);
        view()->share('app_logo', $app_logo);
        view()->share('app_logo_light', $app_logo_light);
        view()->share('app_email', $app_email);
        view()->share('app_phone', $app_phone);
        view()->share('app_location', $app_location);
        view()->share('app_email2', $app_email2);
        view()->share('app_phone2', $app_phone2);
        view()->share('app_copyright', $app_copyright);
        view()->share('app_links_title', $app_links_title);
        view()->share('app_download_title', $app_download_title);
        view()->share('app_contact_title', $app_contact_title);
        view()->share('app_provider_title', $app_provider_title);
        view()->share('app_provider_subtitle', $app_provider_subtitle);
        view()->share('app_email_title', $app_email_title);
        view()->share('app_feedback_title', $app_feedback_title);
        view()->share('app_feedback_subtitle', $app_feedback_subtitle);
        view()->share('app_feedback_footer', $app_feedback_footer);
        view()->share('socials', $socials);
        view()->share('app_store', $app_store);
        view()->share('google_play', $google_play);
    }
}
