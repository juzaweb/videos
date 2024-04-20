<?php

namespace Juzaweb\Videos\Tests\Unit;

use Illuminate\Support\Collection;
use Juzaweb\Tests\TestCase;
use Juzaweb\Videos\Support\VideoSources\Youtube;

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

class TestYoutubeSource extends TestCase
{
    public function testGetVideoById(): void
    {
        $yt = new Youtube(['api_key' => config('services.youtube.api_key')]);

        $this->assertIsArray($yt->get('EaoHrwexz_M'));

        $this->assertArrayHasKey('title', $yt->get('EaoHrwexz_M'));
    }

    public function testSearchVideo(): void
    {
        $yt = new Youtube(['api_key' => config('services.youtube.api_key')]);

        dd($yt->search('game of thrones'));
    }
}
