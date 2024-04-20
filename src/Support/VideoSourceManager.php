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

    public function guess(string $url): ?VideoSource
    {
        foreach ($this->list() as $key => $item) {
            if (empty($item['regex'])) {
                continue;
            }

            if (is_array($item['regex'])) {
                foreach ($item['regex'] as $regex) {
                    if (preg_match($regex, $url)) {
                        return $this->find($key);
                    }
                }
            } elseif (preg_match($item['regex'], $url)) {
                return $this->find($key);
            }
        }

        return null;
    }

    public function list(): array
    {
        return static::$sources;
    }
}
