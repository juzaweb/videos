<?php

namespace Juzaweb\Videos\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\Videos\Actions\ConfigAction;
use Juzaweb\Videos\Actions\MenuAction;
use Juzaweb\Videos\Contracts\VideoSourceManager;
use Juzaweb\Videos\Support\VideoSources;

class VideosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app[VideoSourceManager::class]->register('youtube', VideoSources\Youtube::class, [
            'regex' => [
                '/https?:\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
                '/https?:\/\/youtu\.be\/([a-zA-Z0-9_-]+)/',
                '/https?:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
            ],
            'api_key' => config('youtube_api_key'),
        ]);

        $this->registerHookActions([MenuAction::class, ConfigAction::class]);
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
