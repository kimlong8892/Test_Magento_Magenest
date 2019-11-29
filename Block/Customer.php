<?php


namespace Magenest\Movie\Block;


use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManager;
use Magento\Store\Model\StoreManagerInterface;

class Customer extends Template
{
    protected $_storeManager;
    protected $_customerModel;
    protected $_customerSession;
    public function __construct
    (
        Template\Context $context, array $data = [],
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Customer $customerModel,
        SessionFactory $customerSession

    )
    {
        parent::__construct($context, $data);
        $this -> _storeManager = $storeManager;
        $this -> _customerModel = $customerModel;
        $this->_customerSession = $customerSession->create();
    }

    public function getUrlAvatar()
    {
        $customerData = $this -> _customerModel -> load($this -> _customerSession -> getId());
        $url = $customerData -> getData('avatar');
        if($url == "")
            return false;
        return $this->_storeManager->getStore()->getBaseUrl().'pub/media/customer'.$url;

    }
}