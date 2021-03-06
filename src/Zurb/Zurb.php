<?php

namespace LaravelDeep\LaravelScaffoldingPresets\Zurb;

use Illuminate\Support\Arr;
use Illuminate\Foundation\Console\Presets\Preset;
use Illuminate\Filesystem\Filesystem;

class Zurb extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install()
    {
        static::updatePackages();
        static::updateSass();
        static::updateBootstrapping();
        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        return [
            'foundation-sites' => '^6.4.1',
            'jquery' => '^2.2.4',
        ] + Arr::except($packages, ['bootstrap-sass', 'bulma']);
    }

    /**
     * Update the Sass files for the application.
     *
     * @return void
     */
    protected static function updateSass()
    {
        // clean up the files used by other frameworks
        (new Filesystem)->delete(
            resource_path('assets/sass/_variables.scss')
        );
        (new Filesystem)->delete(
            resource_path('assets/sass/bulma.sass')
        );
        (new Filesystem)->delete(
            resource_path('assets/sass/initial-variables.sass')
        );

        copy(__DIR__.'/zurb-stubs/_settings.scss', resource_path('assets/sass/_settings.scss'));
        copy(__DIR__.'/zurb-stubs/app.scss', resource_path('assets/sass/app.scss'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        (new Filesystem)->delete(
            resource_path('assets/js/bootstrap.js')
        );

        copy(__DIR__.'/zurb-stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
    }
}
