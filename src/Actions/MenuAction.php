<?php

namespace Juzaweb\Videos\Actions;

use Juzaweb\CMS\Abstracts\Action;

class MenuAction extends Action
{
    public function handle(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'init']);
        $this->addAction('post_type.videos.btn_group', [$this, 'addImportButton']);
        $this->addAction(
            'post_type.videos.index',
            [$this, 'addModalImport']
        );
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
                    ],
                    'video_quality' => [
                        'type' => 'select',
                        'label' => trans('Video Quality'),
                        'data' => [
                            'options' => [
                                'HD' => 'HD',
                                'Full HD' => 'Full HD',
                                'SD' => 'SD',
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    public function addImportButton(): void
    {
        echo '<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#import-modal">
        <i class="fa fa-download"></i> '. __('Import') .'
        </a>';
    }

    public function addModalImport(): void
    {
        echo view('jw_videos::components.import')->render();
    }
}
