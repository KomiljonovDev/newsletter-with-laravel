<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailChimNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {

            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us18'
            ]);

            return new MailChimNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();


        Gate::define('admin', function (User $user)
        {
            if ($user->username ?? false) {
                return $user->username == 'newsletteradmin';
            }
                return false;
        });

        Blade::if('admin', function ()
        {
            if (request()->user() ?? false) {
                return request()->user()->can('admin');
            }
            return false;
        });
    }
}
