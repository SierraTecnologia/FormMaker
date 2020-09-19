<?php

namespace SierraTecnologia\FormMaker;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\FormMaker\Services\FormMaker;
use SierraTecnologia\FormMaker\Services\InputMaker;
use SierraTecnologia\FormMaker\Services\FormAssets;
use SierraTecnologia\FormMaker\Commands\MakeFieldCommand;
use SierraTecnologia\FormMaker\Commands\MakeBaseFormCommand;
use SierraTecnologia\FormMaker\Commands\MakeFormTestCommand;
use SierraTecnologia\FormMaker\Commands\MakeModelFormCommand;
use SierraTecnologia\FormMaker\Commands\MakeFormFactoryCommand;
use Illuminate\Foundation\AliasLoader;

class FormMakerProvider extends ServiceProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
            __DIR__ . '/../publishes/config/form-maker.php' => base_path('config/form-maker.php'),
            ]
        );
        

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        // Form Maker
        Blade::directive(
            'form_maker_table', function ($expression) {
                return "<?php echo FormMaker::fromTable($expression); ?>";
            }
        );

        Blade::directive(
            'form_maker_array', function ($expression) {
                return "<?php echo FormMaker::fromArray($expression); ?>";
            }
        );

        Blade::directive(
            'form_maker_object', function ($expression) {
                return "<?php echo FormMaker::fromObject($expression); ?>";
            }
        );

        Blade::directive(
            'form_maker_columns', function ($expression) {
                return "<?php echo FormMaker::getTableColumns($expression); ?>";
            }
        );

        // Label Maker
        Blade::directive(
            'input_maker_label', function ($expression) {
                return "<?php echo InputMaker::label($expression); ?>";
            }
        );

        Blade::directive(
            'input_maker_create', function ($expression) {
                return "<?php echo InputMaker::create($expression); ?>";
            }
        );
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Providers
        |--------------------------------------------------------------------------
        */

        $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        /*
        |--------------------------------------------------------------------------
        | Register the Utilities
        |--------------------------------------------------------------------------
        */

        $this->app->singleton(
            'FormMaker', function () {
                return new FormMaker();
            }
        );

        $this->app->singleton(
            'InputMaker', function () {
                return new InputMaker();
            }
        );

        $this->app['blade.compiler']->directive(
            'formMaker', function () {
                return "<?php echo app('" . FormAssets::class . "')->render(); ?>";
            }
        );

        $loader = AliasLoader::getInstance();

        $loader->alias('FormMaker', \SierraTecnologia\FormMaker\Facades\FormMaker::class);
        $loader->alias('InputMaker', \SierraTecnologia\FormMaker\Facades\InputMaker::class);

        // Thrid party
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
        /*
        |--------------------------------------------------------------------------
        | Commands
        |--------------------------------------------------------------------------
        */

        $this->commands(
            [
            MakeFieldCommand::class,
            MakeModelFormCommand::class,
            MakeBaseFormCommand::class,
            MakeFormFactoryCommand::class,
            MakeFormTestCommand::class,
            ]
        );

        $this->app->singleton(
            FormAssets::class, function ($app) {
                return new FormAssets($app);
            }
        );
    }
    
}
