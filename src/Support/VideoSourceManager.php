<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\Videos\Support;

use Juzaweb\Videos\Contracts\VideoSource;
use Juzaweb\Videos\Contracts\VideoSourceManager as VideoSourceManagerContract;

class VideoSourceManager implements VideoSourceManagerContract
{
    protected static array $sources = [];

    public function register(string $key, string $class, array $config = []): void
    {
        $config['class'] = $class;

        static::$sources[$key] = $config;
    }

    public function find(string $key): ?VideoSource
    {
        return static::$sources[$key] ?? null;
    }

    public function list(): array
    {
        return static::$sources;
    }
}
