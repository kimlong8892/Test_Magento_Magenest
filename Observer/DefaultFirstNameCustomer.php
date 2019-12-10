<?php


namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;

class DefaultFirstNameCustomer implements ObserverInterface
{
    protected $_request;
    protected $_layout;
    protected $_objectManager = null;
    protected $_customerGroup;
    private $logger;
    protected $_customerRepositoryInterface;

    protected $_customerModelFactory;

    public function __construct
    (
        \Magento\Framework\View\Element\Context $context,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\CustomerFactory $customerModelFactory
    )
    {
        $this->_layout = $context->getLayout();
        $this->_request = $context->getRequest();
        $this->_objectManager = $objectManager;
        $this->logger = $logger;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerModelFactory = $customerModelFactory;
    }

    public function execute(EventObserver $observer)
    {

        $customer = $observer->getCustomerDataObject();
        $customerId = $customer->getId();
        $customerData = $this->_customerModelFactory->create()->load($customerId);
        $customerData->setData('firstname', 'Magenest');
        $customerData->save();
    }
}