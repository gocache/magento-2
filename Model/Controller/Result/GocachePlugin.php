<?php

namespace GoCache\CDN\Model\Controller\Result;

use Laminas\Http\Header\HeaderInterface as HttpHeaderInterface;
use Magento\Framework\App\PageCache\Kernel;
use Magento\Framework\App\Response\Http as ResponseHttp;
use Magento\Framework\App\State as AppState;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\PageCache\Model\Cache\Type as CacheType;
use Magento\PageCache\Model\Config;

class GocachePlugin
{

    const HEADER_CACHE_TAGS = 'Cache-Tags';

    private \Magento\Framework\App\Cache\StateInterface $cacheState;
    private \GoCache\CDN\Model\Config $config;
    private Registry $registry;
    private Kernel $kernel;

    /**
     * @param \Magento\Framework\App\Cache\StateInterface $cacheState
     * @param \GoCache\CDN\Model\Config $config
     * @param Registry $registry
     * @param Kernel $kernel
     */
    public function __construct(
        \Magento\Framework\App\Cache\StateInterface $cacheState,
        \GoCache\CDN\Model\Config $config,
        Registry $registry,
        Kernel $kernel
    )
    {
        $this->cacheState = $cacheState;
        $this->config = $config;
        $this->registry = $registry;
        $this->kernel = $kernel;
    }


    /**
     * Perform result postprocessing
     *
     * @param ResultInterface $subject
     * @param ResultInterface $result
     * @param ResponseHttp $response
     * @return ResultInterface
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterRenderResult(ResultInterface $subject, ResultInterface $result, ResponseHttp $response)
    {
        $usePlugin = $this->registry->registry('use_page_cache_plugin');

        if (!$usePlugin || !$this->isEnabled() || !$this->config->isEnabled()) {
            return $result;
        }

        // just add header if the header don't exist
        $cacheTags = $response->getHeader(self::HEADER_CACHE_TAGS);
        if ($cacheTags) {
            return $result;
        }

        $tagsHeader = $response->getHeader('X-Magento-Tags');
        $tags = [];

        if ($tagsHeader) {
            $tags = explode(',', $tagsHeader->getFieldValue());
        }

        $tags = array_unique($tags);
        $response->setHeader(self::HEADER_CACHE_TAGS, implode(',', $tags));
        $this->kernel->process($response);

        return $result;
    }

    /**
     * Whether a cache type is enabled in Cache Management Grid
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->cacheState->isEnabled(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER);
    }
}
