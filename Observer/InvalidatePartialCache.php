<?php

namespace GoCache\CDN\Observer;

use GoCache\CDN\Model\Config;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class InvalidatePartialCache implements ObserverInterface
{
    /**
     * @var GoCache\CDN\Model\Config
     */
    private $config;

    private $alreadyExistsTags = [];
    /**
     * @var \GoCache\CDN\Model\Purge
     */
    private $purge;

    /**
     * InvalidatePartialCache constructor.
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

        /** @var \Magento\Framework\DataObject\IdentityInterface $object */
        $object = $observer->getEvent()->getObject();
        if(!($object instanceof \Magento\Framework\DataObject\IdentityInterface)) {
            return;
        }

        $tags = [];
        foreach ($object->getIdentities() as $tag) {
            if(in_array($tag, $this->alreadyExistsTags)) {
                continue;
            }

            $tags[] = $tag;
            $this->alreadyExistsTags[] = $tag;
        }

        if (empty($tags)) {
            return;
        }

        $this->purge->purgeByTags($tags);
    }
}
