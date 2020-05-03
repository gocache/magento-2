<?php

namespace GoCache\CDN\Observer;


use GoCache\CDN\Model\Config;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FlushAllCache implements ObserverInterface
{
    /**
     * @var \GoCache\CDN\Model\Config
     */
    private $config;
    /**
     * @var \GoCache\CDN\Model\Purge
     */
    private $purge;


    /**
     * FlushAllCache constructor.
     * @param \GoCache\CDN\Model\Config $config
     * @param \GoCache\CDN\Model\Purge $purge
     */
    public function __construct(
        \GoCache\CDN\Model\Config $config,
        \GoCache\CDN\Model\Purge $purge
    )
    {
        $this->config = $config;
        $this->purge = $purge;
    }

    public function execute(Observer $observer)
    {
        if (!$this->config->isEnabled()) {
            return;
        }

        if ($this->config->getType() !== Config::GOCACHE) {
            return;
        }

        $this->purge->purgeAll();
    }


}
