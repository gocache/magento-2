<?php

namespace GoCache\CDN\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class FlushCatalogImage implements ObserverInterface
{
    /**
     * @var \GoCache\CDN\Model\Purge
     */
    private $purge;

    /**
     * FlushCatalogImage constructor.
     * @param \GoCache\CDN\Model\Purge $purge
     */
    public function __construct(
        \GoCache\CDN\Model\Purge $purge
    )
    {
        $this->purge = $purge;
    }


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $this->purge->purgeCatalogImage();
    }
}
