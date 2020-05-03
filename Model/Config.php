<?php

namespace GoCache\CDN\Model;


class Config extends \Magento\PageCache\Model\Config
{
    /**
     * Cache types
     */
    const GOCACHE = 'gocache';

    /**
     * GoCache endpoint
     */
    const GOCACHE_API_ENDPOINT = 'https://api.gocache.com.br/v1';

    /**
     * path to token config
     */
    const XML_GOCACHE_TOKEN = "system/full_page_cache/gocache/token";

    /**
     * path to token config
     */
    const XML_GOCACHE_MAIN_DOMAIN = "system/full_page_cache/gocache/main_domain";

    /**
     * enable log
     */
    const XML_GOCACHE_ENABLE_LOG = "system/full_page_cache/gocache/enable_log";

    public function getEndpoint()
    {
        return self::GOCACHE_API_ENDPOINT;
    }

    /**
     * Return GoCache token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->_scopeConfig->getValue(self::XML_GOCACHE_TOKEN);
    }

    /**
     * Return GoCache token
     *
     * @return string
     */
    public function getMainDomain()
    {
        return $this->_scopeConfig->getValue(self::XML_GOCACHE_MAIN_DOMAIN);
    }

    /**
     * Return enable log flag
     *
     * @return string
     */
    public function isLogEnable()
    {
        return $this->_scopeConfig->getValue(self::XML_GOCACHE_ENABLE_LOG);
    }
}