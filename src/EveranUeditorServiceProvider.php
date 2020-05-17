<?php

namespace Dcat\Admin\Extension\UEditor;

use Dcat\Admin\Form;
use Illuminate\Support\ServiceProvider;

class EveranUeditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $extension = EveranUeditor::make();

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, EveranUeditor::NAME);
        }

        if ($lang = $extension->lang()) {
            $this->loadTranslationsFrom($lang, EveranUeditor::NAME);
        }

        if ($migrations = $extension->migrations()) {
            $this->loadMigrationsFrom($migrations);
        }

        $this->app->booted(function () use ($extension) {
            $extension->routes(__DIR__.'/../routes/web.php');
        });

        if ($this->app->runningInConsole() || request()->getMethod() == 'POST') {
            $this->publishes([__DIR__.'/../config' => config_path()]);
        }

        Form::extend('UEditor', \Dcat\Admin\Extension\UEditor\Form\UEditor::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {}
}
