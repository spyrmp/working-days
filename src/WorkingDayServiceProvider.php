<?php

namespace Spyrmp\WorkingDays;

use Spyrmp\WorkingDays\Rules\IsWorkingDayValidation;
use Spyrmp\WorkingDays\Rules\IsNonWorkingDayValidation;
use Illuminate\Support\ServiceProvider;
use Validator;

class WorkingDayServiceProvider extends ServiceProvider
{


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


        $this->app->singleton('working-days', function ($app) {
            return new WorkingDays($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        /*

          $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'working-days');
          $this->publishes([
              __DIR__ . '/../resources/lang' => resource_path('lang/vendor/working-days'),
          ],"working-days");*/
        $this->loadConfig();
        $this->loadTranslations();
        $this->registerRules();

    }

    /**
     * Load the package config.
     *
     * @return void
     */
    private function loadConfig()
    {
        $configPath = $this->packagePath('config/working-days.php');
        $this->mergeConfigFrom($configPath, 'working-days');
        $this->publishes([$configPath => config_path('working-days.php')], 'working-days');
    }

    /**
     * Get the absolute path to some package resource.
     *
     * @param string $path The relative path to the resource
     * @return string
     */
    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

    /**
     * Load the package translations.
     *
     * @return void
     */
    private function loadTranslations()
    {
        $translationsPath = $this->packagePath('resources/lang');
        $this->loadTranslationsFrom($translationsPath, 'working-days');
        $this->publishes([$translationsPath => resource_path('lang/vendor/working-days')], "working-days");
    }

    private function registerRules()
    {
        Validator::replacer('is_working_day', function () {

            return (new IsWorkingDayValidation)->message();
        });
        Validator::extend('is_working_day', function ($attribute, $value) {
            return (new IsWorkingDayValidation)->passes($attribute, $value);

        });
        Validator::replacer('IsNonWorkingDayValidation', function () {
            return (new IsNonWorkingDayValidation)->message();

        });
        Validator::extend('is_not_working_day', function ($attribute, $value) {
            return (new IsNonWorkingDayValidation)->passes($attribute, $value);

        });
    }


}
