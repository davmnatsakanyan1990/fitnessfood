<?php
/**
 * Created by PhpStorm.
 * User: Designer
 * Date: 07.02.2017
 * Time: 10:17
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer(
            ['recipes', 'home', 'about', 'basket', 'contact', 'trainer.auth.*'], 'App\Http\ViewComposers\BasketComposer'
        );

        view()->composer(
            ['home',  'basket', 'about'], 'App\Http\ViewComposers\MainComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}