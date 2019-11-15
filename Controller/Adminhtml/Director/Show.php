<?php


namespace Magenest\Movie\Controller\Adminhtml\Director;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Show extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}