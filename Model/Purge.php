<?php

namespace GoCache\CDN\Model;

class Purge
{
    /**
     * @var Api
     */
    private $api;

    /**
     * Purge constructor.
     * @param Api $api
     */
    public function __construct(
        Api $api
    )
    {
        $this->api = $api;
    }

    public function purgeByTags($tags = [])
    {
        $this->api->purgeByTags($tags);
    }

    public function purgeAll()
    {
        $this->api->purgeAll();
    }

    public function purgeStatic()
    {
        $this->api->purgeByContentType('application/javascript');
    }

    public function purgeCatalogImage()
    {
        $this->api->purgeByContentType('image/*');
    }
    public function purgeMedia()
    {
        $this->api->purgeByContentType('text/css');
        $this->api->purgeByContentType('application/javascript');
    }
}