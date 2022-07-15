<?php

namespace GoCache\CDN\Model;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger;

class Handler extends BaseHandler
{

    /**
     * Logging level
     * @var int
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * File name
     * @var string
     */
    protected $fileName = '/var/log/gocache.log';
    /**
     * @var Config
     */
    private $config;

    /**
     * Logger constructor.
     * @param DriverInterface $filesystem
     * @param string|null $filePath
     * @param string|null $fileName
     * @param Config $config
     */
    public function __construct(
        DriverInterface $filesystem,
        Config $config,
        ?string $filePath = null,
        ?string $fileName = null,
    )
    {
        parent::__construct($filesystem, $filePath, $fileName);
        $this->config = $config;
    }

    public function write(array $record): void
    {
        if (!$this->config->isLogEnable()) {
            return;
        }
        parent::write($record); // TODO: Change the autogenerated stub
    }


}
