<?php
/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://juzaweb.com
 * @license    GNU V2
 */

namespace Juzaweb\Videos\Support\VideoSources;

use Google\Service\YouTube as YoutubeService;
use Juzaweb\Videos\Contracts\VideoSource;
use Google\Client as GoogleClient;

class Youtube implements VideoSource
{
    protected ?GoogleClient $client = null;

    public function __construct(protected array $config = [])
    {
    }

    public function get(string $video)
    {
        $youtube = new YoutubeService($this->getGoogleClient());
        $youtube->videos->listVideos('id,snippet', $video);

        return [];
    }

    protected function getGoogleClient(): GoogleClient
    {
        if ($this->client) {
            return $this->client;
        }

        $client = new GoogleClient();
        $client->setDeveloperKey('AIzaSyD3FmDdW5w2Z5w5Hn9LbHn9eJxYzRZKoqY');
        return $this->client = $client;
    }
}
