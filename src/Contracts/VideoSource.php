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
    public function get(string $video): array;

    public function search(string $keyword): Collection;
}
