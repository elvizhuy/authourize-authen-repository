<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $directories = array_map('basename', File::directories(__DIR__));
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $configPath = __DIR__ . '/' . $directory . "/configs";
                if (File::exists($configPath)) {
                    $configFiles = array_map('basename', File::allFiles($configPath));
                    foreach ($configFiles as $config) {
                        $alias = basename($config, ".php");
                        $path = $configPath . '/' . $config;
                        $this->mergeConfigFrom($path, $alias);
                    }
                }
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $directories = array_map('basename', File::directories(__DIR__));
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $this->registerModule($directory);
            }
        }
    }

    public function registerModule($module)
    {
        $modulePath = __DIR__ . "/$module";
        if (File::exists($modulePath . "/routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "/routes/routes.php");
        }
        if (File::exists($modulePath . "/migrations")) {
            $this->loadMigrationsFrom($modulePath . "/migrations");
        }
        if (File::exists($modulePath . "/resources/lang")) {
            $this->loadTranslationsFrom($modulePath . "/resources/lang", $module);
            $this->loadJsonTranslationsFrom($modulePath . "/resources/lang");
        }
        if (File::exists($modulePath . "/resources/views")) {
            $this->loadViewsFrom($modulePath . "/resources/views", $module);
        }
        if (File::exists($modulePath . "/helpers")) {
            $helpersList = File::allFiles($modulePath . "/helpers");
            if (!empty($helpersList)) {
                foreach ($helpersList as $item) {
                    $path = $item->getPathname();
                    require $path;
                }
            }
        }
    }
}

