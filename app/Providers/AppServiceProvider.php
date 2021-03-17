<?php

namespace App\Providers;
use App\Shop;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Product;
use App\Observers\ProductObserver;

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
        Blade::directive('routeactive',function($route){
          return "<?php echo Route::currentRouteNamed($route) ? 'class=\"active\"' : '' ?>";
        });
        Blade::if('admin',function(){
          return Auth::check() && Auth::user()->isAdmin();
        });
        Blade::if('mainadmin', function(){
            return Auth::user()->MainAdmin();
        });

        Product::observe(ProductObserver::class);
    }
}
