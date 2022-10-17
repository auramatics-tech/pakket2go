<?php
//Same parameters and a new $lang parameter
use Illuminate\Support\Str;

if (function_exists('CheckInvalidPlan')) {
    function route($name, $parameters = [], $absolute = true, $lang = null)
    {

        echo $name; die;
        /*
    * Remember the ajax routes we wanted to exclude from our lang system?
    * Check if the name provided to the function is the one you want to
    * exclude. If it is we will just use the original implementation.
    **/
        if (Str::contains($name, ['ajax', 'autocomplete'])) {
            return app('url')->route($name, $parameters, $absolute);
        }

        //Check if $lang is valid and make a route to chosen lang
        if ($lang && in_array($lang, config('app.alt_langs'))) {
            return app('url')->route($lang . '_' . $name, $parameters, $absolute);
        }

        /**
         * For all other routes get the current locale_prefix and prefix the name.
         */
        $locale_prefix = config('app.locale_prefix');
        if ($locale_prefix == '') $locale_prefix = 'pl';
        return app('url')->route($locale_prefix . '_' . $name, $parameters, $absolute);
    }
}
