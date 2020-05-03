<?php

namespace GoCache\CDN\Observer;

use GoCache\CDN\Model\Api;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class UpdateConfig implements ObserverInterface
{
    private $_mapConfig = [
        'smartcache'    => 'smart_status',
        'ttl_cdn'       => 'smart_ttl',
        'ttl_browser'   => 'expires_ttl',
    ];

    /**
     * @var RequestInterface
     */
    private $request;
    /**
     * @var Api
     */
    private $api;

    /**
     * UpdateConfig constructor.
     * @param RequestInterface $request
     * @param Api $api
     */
    public function __construct(
        RequestInterface $request,
        Api $api
    )
    {
        $this->request = $request;
        $this->api = $api;
    }


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $fpcParams = $this->request->getParam('groups');
        $fields = $fpcParams['full_page_cache']['groups']['gocache']['fields'];
        $param = [];
        foreach ($fields as $key=>$value) {
            if (!in_array($key, array_keys($this->_mapConfig))) {
                continue;
            }

            $value = $value['value'];
            if ($key == 'smartcache') {
                $value = $value ? 'true' : 'false';
            }

            $param[$this->_mapConfig[$key]] = $value;
        }
        $this->api->updateConfig($param);
    }
}