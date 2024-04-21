<?php

namespace Juzaweb\Videos\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\Videos\Contracts\VideoSourceManager;
use Juzaweb\Videos\Http\Requests\ImportRequest;

class VideoController extends BackendController
{
    public function __construct(protected VideoSourceManager $videoSourceManager)
    {
    }

    public function import(ImportRequest $request)
    {
        $source = $this->videoSourceManager->guess($request->input('source_url'));

        abort_if($source === null, 422, __('Video URL not supported'));

        $post = DB::transaction(
            function () use ($source, $request) {
                return $this->videoSourceManager->import($source, $request->input('source_url'));
            }
        );

        return $this->success(
            [
                'message' => __('Video imported successfully'),
                'redirect' => route('admin.posts.edit', ['videos', $post->id]),
            ]
        );
    }
}
