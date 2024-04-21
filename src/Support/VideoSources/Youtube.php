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
use Illuminate\Support\Collection;
use Juzaweb\Videos\Contracts\VideoSource;
use Google\Client as GoogleClient;

class Youtube implements VideoSource
{
    protected ?GoogleClient $client = null;

    public function __construct(protected array $config = [])
    {
    }

    public function get(string $video): array
    {
        $youtube = new YoutubeService($this->getGoogleClient());

        $videos = $youtube->videos->listVideos('id,snippet', ['id' => get_youtube_id($video)]);

        return $this->getDataVideo($videos->getItems()[0]);
    }

    public function search(string $keyword): Collection
    {
        $youtube = new YoutubeService($this->getGoogleClient());
        $videos = $youtube->search->listSearch(
            'id,snippet',
            [
                'q' => $keyword,
                'maxResults' => 50,
                'type' => 'video',
            ]
        );

        $result = new Collection();
        foreach ($videos->getItems() as $video) {
            $result->push($this->getDataVideo($video));
        }

        return $result;
    }

    protected function getDataVideo(YoutubeService\Video|YoutubeService\SearchResult $video): array
    {
        $videoId = $video instanceof YoutubeService\Video ? $video->getId() : $video->id->videoId;

        return [
            'title' => $video->getSnippet()->title,
            'content' => nl2br($video->getSnippet()->description),
            'thumbnail' => $video->getSnippet()->thumbnails->high->url,
            'tags' => $video->getSnippet()->tags,
            'meta' => [
                'source_url' => 'https://www.youtube.com/watch?v=' . $videoId,
            ],
        ];
    }

    protected function getGoogleClient(): GoogleClient
    {
        if ($this->client) {
            return $this->client;
        }

        $client = new GoogleClient();
        $client->setDeveloperKey($this->config['api_key']);
        return $this->client = $client;
    }
}
