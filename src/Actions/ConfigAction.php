<?php

namespace Juzaweb\Videos\Actions;

use Juzaweb\CMS\Abstracts\Action;

class ConfigAction extends Action
{
    /**
     * Execute the actions.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'init']);
    }

    public function init(): void
    {
        $this->registerSettingPage(
            'videos',
            [
                'label' => __('Setting'),
                'menu' => [
                    'parent' => 'post-type.videos',
                ]
            ]
        );

        $this->addSettingForm(
            'videos',
            [
                'name' => __('Settings'),
                'page' => 'videos',
            ]
        );

        $this->registerConfig(
            [
                'youtube_api_key' => [
                    'label' => __('Youtube API key'),
                    'page' => 'videos',
                    'form' => 'videos',
                ],
            ]
        );
    }
}
