<?php

namespace Juzaweb\Videos\Http\Controllers;

use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\Videos\Http\Requests\ImportRequest;
use Juzaweb\Videos\Support\VideoSourceManager;

class VideoController extends BackendController
{
    public function __construct(protected VideoSourceManager $videoSourceManager)
    {
    }

    public function import(ImportRequest $request)
    {
        //
    }
}
