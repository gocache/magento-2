<?php

namespace GoCache\CDN\Model;

class Logger extends \Zend\Log\Logger
{
    const GOCACHE_LOGFILE = '/var/log/gocache.log';
    /**
     * @var Config
     */
    private $config;

    /**
     * Logger constructor.
     * @param Config $config
     * @param null $options
     */
    public function __construct(
        Config $config,
        $options = null
    )
    {
        parent::__construct($options);
        $this->addWriter($this->getWriter());
        $this->config = $config;
    }

    private function getWriter()
    {
        return new \Zend\Log\Writer\Stream(BP.self::GOCACHE_LOGFILE);
    }

    public function log($priority, $message, $extra = [])
    {
        if ($this->config->isLogEnable()) {
            return parent::log($priority, $message, $extra);
        }
    }


}