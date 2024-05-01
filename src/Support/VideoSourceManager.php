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

use Juzaweb\Backend\Models\Post;
use Juzaweb\Backend\Repositories\PostRepository;
use Juzaweb\CMS\Support\Application;
use Juzaweb\Videos\Contracts\VideoSource;
use Juzaweb\Videos\Contracts\VideoSourceManager as VideoSourceManagerContract;

class VideoSourceManager implements VideoSourceManagerContract
{
    protected static array $sources = [];

    public function __construct(protected Application $app)
    {
    }

    public function register(string $key, string $class, array $config = []): void
    {
        $config['class'] = $class;

        static::$sources[$key] = $config;
    }

    public function find(string $key): ?VideoSource
    {
        if (isset(static::$sources[$key])) {
            return new static::$sources[$key]['class'](static::$sources[$key]);
        }

        return null;
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

    public function import(VideoSource $source, string $url, array $append = []): Post
    {
        $data = $source->get($url);
        $data['type'] = 'videos';
        $data = array_merge($data, $append);

        $post = $this->app[PostRepository::class]->create($data);

        $post->setMeta('source_url', $url);

        return $post;
    }

    public function list(): array
    {
        return static::$sources;
    }
}
