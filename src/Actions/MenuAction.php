<?php

namespace Juzaweb\Videos\Actions;

use Juzaweb\CMS\Abstracts\Action;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'init']);
    }

    public function init(): void
    {
        $this->hookAction->registerPostType(
            'videos',
            [
                'label' => trans('Videos'),
                'menu_icon' => 'fa fa-file-video-o',
                'priority' => 30,
                'supports' => [
                    'category',
                    'tag',
                    'thumbnail',
                ],
                'metas' => [
                    'source_url' => [
                        'type' => 'upload_url',
                        'label' => trans('Source URL'),
                    ]
                ]
            ]
        );
    }
}
