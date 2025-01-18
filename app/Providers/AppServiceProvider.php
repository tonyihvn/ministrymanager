<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\tasks;
use App\Models\User;
use App\Models\settings;
use App\Models\ministrygroup;

use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using view composer to set following variables globally


        view()->composer('*',function($view) {

            if (Auth::check())
            {
                $view->with('login_user', Auth::user());
                $view->with('mytasks', tasks::where('assigned_to',Auth::user()->id)->where('status','Not Completed')->get());
                $view->with('hmembers', User::select('id','name','status','phone_number')->where('settings_id',Auth::user()->settings_id)->get());
                $view->with('userministries',settings::select('id','ministry_name','ministrygroup_id')->where('user_id',Auth::user()->id)->get());

                $view->with('settings', settings::where('id',Auth::user()->settings_id)->first());
            }else{
                $view->with('settings', settings::where('id',2)->first());
            }

            $view->with('ministrygroups',ministrygroup::select('id','ministry_group_name')->get());

            // if you need to access in controller and views:
            // Config::set('something', $something);
        });
    }
}
