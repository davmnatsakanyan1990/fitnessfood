<?php


namespace App\Http\ViewComposers;

use App\Models\Setting;
use Illuminate\View\View;


class MainComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $settings = Setting::first();


        $view->with(['wrk_hr_from' => $settings->wrk_hr_from, 'wrk_hr_to' => $settings->wrk_hr_to]);
    }

}