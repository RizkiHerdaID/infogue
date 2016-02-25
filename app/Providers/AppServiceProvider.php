<?php

namespace Infogue\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Infogue\Category;
use Infogue\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('site_settings', function(){
            $settings = Setting::all();
            $keys = array();
            foreach($settings as $setting){
                $keys[$setting->key] = $setting->value;
            }
            return $keys;
        });

        View::share('site_settings', app('site_settings'));

        $this->app->singleton('site_menus', function(){
            $categories = Category::all();
            return $categories;
        });

        View::share('site_menus', app('site_menus'));

        Validator::extend('check_password', function($attribute, $value, $parameter){
            return Hash::check($value, Auth::user()->getAuthPassword());
        });

        Blade::directive('datetime', function($expression) {
            return "<?php echo with{$expression}->format('d/m/Y H:i'); ?>";
        });

        Blade::directive('simpledate', function($expression) {
            return "<?php echo with{$expression}->format('d M Y'); ?>";
        });

        Blade::directive('fulldate', function($expression) {
            return "<?php echo with{$expression}->format('d F Y'); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
