<?php

namespace GoCache\CDN\Plugin\Model\System\Config\Source;

use GoCache\CDN\Model\Config;

class ApplicationPlugin
{
    /**
     * @param \Magento\PageCache\Model\System\Config\Source\Application $subject
     * @param array $optionArray
     * @return array
     */
    public function afterToOptionArray(\Magento\PageCache\Model\System\Config\Source\Application $subject, array $optionArray)
    {
        return array_merge($optionArray, [['value' => Config::GOCACHE, 'label' => __('GoCache CDN')]]);
    }


    /**
     * @param \Magento\PageCache\Model\System\Config\Source\Application $subject
     * @param array $optionArray
     * @return array
     */
    public function afterToArray(\Magento\PageCache\Model\System\Config\Source\Application $subject, array $optionArray)
    {
        $optionArray[Config::GOCACHE] = __('GoCache CDN');
        return $optionArray;
    }
}