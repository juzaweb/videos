<?php

namespace Juzaweb\Videos\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;

class VideosController extends BackendController
{
    public function index()
    {
        //

        return view(
            'jw_videos::index',
            [
                'title' => 'Title Page',
            ]
        );
    }
}
