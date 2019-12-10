<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\MovieFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    private $_movieModelFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MovieFactory $movieModelFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_movieModelFactory = $movieModelFactory;
    }

    public function execute()
    {
        $selects = $this->_request->getParam('selected');
        $modelMovie = $this->_movieModelFactory->create();
        $countDelete = 0;
        foreach ($selects as $select) {
            $modelMovie->load($select);
            $modelMovie->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Movie', $countDelete));
        return $resultRedirect->setPath('movie/movie/show');
    }
}
