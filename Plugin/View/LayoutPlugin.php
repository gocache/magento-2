<?php

namespace GoCache\CDN\Plugin\View;

use GoCache\CDN\Model\Config;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Module\ModuleListInterface;

class LayoutPlugin
{
    const MODULE_NAME = "GoCache_CDN";

    const PAGE_CACHEABLE_MESSAGE = "gocache-page-cacheable";

    const HEADER_MODULE_MESSAGE = "Gocache-Module-Enabled";

    /**
     * @var ModuleListInterface
     */
    private $moduleList;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var ResponseInterface
     */
    private $response;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * LayoutPlugin constructor.
     * @param ModuleListInterface $moduleList
     * @param Config $config
     * @param ResponseInterface $response
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        ModuleListInterface $moduleList,
        Config $config,
        ResponseInterface $response,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->moduleList = $moduleList;
        $this->config = $config;
        $this->response = $response;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\View\Layout $subject
     * @param $result
     * @return mixed
     */
    public function afterGetOutput(\Magento\Framework\View\Layout $subject, $result)
    {
        if ($this->config->getType() == Config::GOCACHE) {
            $this->response->setHeader(self::HEADER_MODULE_MESSAGE, $this->getModuleVersion(), true);

        }

        return $result;
    }

    /**
     * Get GoCache module version
     *
     * @return string
     */
    private function getModuleVersion()
    {
        $module = $this->moduleList->getOne(self::MODULE_NAME);
        return $module['setup_version'];
    }

    /**
     * @param \Magento\Framework\View\Layout $subject
     * @param $result
     * @return mixed
     */
    public function afterGenerateXml(\Magento\Framework\View\Layout $subject, $result)
    {
        if ($subject->isCacheable()) {
            $this->response->setHeader(self::PAGE_CACHEABLE_MESSAGE, "YES");
        } else {
            $this->response->setHeader(self::PAGE_CACHEABLE_MESSAGE, "NO");
        }

        return $result;
    }
}