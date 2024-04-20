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

interface VideoSourceManager
{
    /**
     * Register a new source with the given key, class, and optional configuration.
     *
     * @param string $key The key to register the source with.
     * @param string $class The class name associated with the source.
     * @param array $config An optional configuration array for the source.
     */
    public function register(string $key, string $class, array $config = []): void;

    /**
     * Find a specific VideoSource by key.
     *
     * @param string $key The key to search for in the sources array.
     * @return VideoSource|null The found VideoSource object, or null if not found.
     */
    public function find(string $key): ?VideoSource;

    /**
     * The function takes a string $url as input and tries to match it with regex patterns in the list of items.
     *
     * @param string $url The URL to match against regex patterns
     * @return VideoSource|null Returns a VideoSource if a match is found, otherwise null
     */
    public function guess(string $url): ?VideoSource;

    /**
     * Get the list of sources.
     *
     * @return array
     */
    public function list(): array;
}
