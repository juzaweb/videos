<?php

namespace Juzaweb\Videos\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\Videos\Actions\MenuAction;

class VideosServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerHookActions([MenuAction::class]);
    }

    public function register(): void
    {
        //
    }
}
