<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class IndonesiaPhoneValidationProvider extends ServiceProvider
{
/**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('indonesia_phone', function ($attribute, $value, $parameters, $validator) {
            // Define the regex pattern for an Indonesian phone number
            $pattern = '/^(\+62|0)(8[1-9]\d{1,})$/';

            // Check if the value matches the pattern
            return preg_match($pattern, $value);
        });

        Validator::replacer('indonesia_phone', function ($message, $attribute, $rule, $parameters) {
            // Customize the error message for the 'indonesia_phone' rule
            return str_replace(':attribute', $attribute, 'Nomor Telepon Tidak Valid.');
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