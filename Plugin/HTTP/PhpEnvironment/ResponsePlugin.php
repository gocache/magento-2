<?php

namespace GoCache\CDN\Plugin\HTTP\PhpEnvironment;

use GoCache\CDN\Model\Config;

class ResponsePlugin
{
    /**
     * @var Config
     */
    private $config;

    /**
     * ResponsePlugin constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
    }

    public function beforeSetHeader(\Magento\Framework\HTTP\PhpEnvironment\Response $subject, $name, $value, $replace = false)
    {
        if ($this->config->getType() !== Config::GOCACHE) {
            return [$name, $value, $replace];
        }

        // Update header to X-Cache-Tags
        if ($name !== 'X-Magento-Tags') {
            return [$name, $value, $replace];
        }

        return ['Cache-Tags', $value, $replace];
    }
}