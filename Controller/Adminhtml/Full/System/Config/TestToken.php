<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace GoCache\CDN\Controller\Adminhtml\Full\System\Config;

use GoCache\CDN\Model\Api;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filter\StripTags;

class TestToken extends Action
{

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var StripTags
     */
    private $tagFilter;
    /**
     * @var Api
     */
    private $api;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param StripTags $tagFilter
     * @param Api $api
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        StripTags $tagFilter,
        Api $api
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->tagFilter = $tagFilter;
        $this->api = $api;
    }

    /**
     * Check for connection to server
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        $result = [
            'success' => false,
            'errorMessage' => '',
        ];
        $options = $this->getRequest()->getParams();

        try {
            if (empty($options['token'])) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('GoGache Token não encontrado')
                );
            }

            if (empty($options['main_domain'])) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Dominio principal GoCache não encontrado')
                );
            }
            $response = $this->api->testToken($options['token'], $options['main_domain']);
            if ($response) {
                $result['success'] = true;
                /** @var \Magento\Framework\Controller\Result\Json $resultJson */
                $resultJson = $this->resultJsonFactory->create();
                return $resultJson->setData($result);
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $result['errorMessage'] = $e->getMessage();
        } catch (\Exception $e) {
            $message = __($e->getMessage());
            $result['errorMessage'] = $this->tagFilter->filter($message);
        }

        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        return $resultJson->setData($result);
    }
}
