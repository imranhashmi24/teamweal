<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Frontend;
use App\Models\Property;
use App\Constants\Status;
use App\Models\SupportTicket;
use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\FinanceRequest;
use App\Models\MarketingRequest;
use App\Models\PropertyRequest;
use App\Models\ServiceRequest;
use App\Models\PropertyRequestSend;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // custom components

        $this->registerComponents();




        $viewShare['general'] = gs();
        $viewShare['emptyMessage'] = 'Data not found';

        $viewShare['categories'] = Category::where('is_featured', true)->get();

        view()->share($viewShare);

        view()->composer('partials.seo', function ($view) {
            $seo = Frontend::where('data_keys', 'seo.data')->first();
            $view->with([
                'seo' => $seo ? $seo->data_values : $seo,
            ]);
        });


        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'emailUnverifiedUsersCount' => User::emailUnverified()->count(),
                'mobileUnverifiedUsersCount' => User::mobileUnverified()->count(),
                'pendingSupportCount' => SupportTicket::whereIN('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count(),

            ]);
        });

        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications' => AdminNotification::where('is_read', Status::NO)->with('user')->orderBy('id', 'desc')->take(10)->get(),
                'adminNotificationCount' => AdminNotification::where('is_read', Status::NO)->count(),
            ]);
        });

        Paginator::useBootstrapFour();
    }

    public function registerComponents()
    {
        $this->loadHelpers();
    }


    public function loadHelpers()
    {
        foreach (glob(app_path() . '/Components/*.php') as $filename) {
            require_once $filename;
        }
    }
}
