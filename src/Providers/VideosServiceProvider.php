<?php

namespace Juzaweb\Videos\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\Videos\Actions\MenuAction;
use Juzaweb\Videos\Contracts\VideoSourceManager;
use Juzaweb\Videos\Support\VideoSources;

class VideosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app[VideoSourceManager::class]->register('youtube', VideoSources\Youtube::class);

        $this->registerHookActions([MenuAction::class]);
    }

    public function register(): void
    {
        $this->app->singleton(
            VideoSourceManager::class,
            function () {
                return new \Juzaweb\Videos\Support\VideoSourceManager();
            }
        );
    }
}
