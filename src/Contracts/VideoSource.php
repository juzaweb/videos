<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\Videos\Contracts;

use Illuminate\Support\Collection;

interface VideoSource
{
    /**
     * Get a specific video.
     *
     * @param string $video The video to retrieve.
     * @return array
     */
    public function get(string $video): array;

    /**
     * Search for a specific keyword.
     *
     * @param string $keyword The keyword to search for.
     * @return Collection
     */
    public function search(string $keyword): Collection;
}
