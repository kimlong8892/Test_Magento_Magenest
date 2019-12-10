<?php

namespace Magenest\Movie\Controller\Adminhtml\Director;

use Magenest\Movie\Model\DirectorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    private $_directorModelFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DirectorFactory $directorModelFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_directorModelFactory = $directorModelFactory;
    }

    public function execute()
    {
        $selects = $this->_request->getParam('selected');
        $modelDirector = $this->_directorModelFactory->create();
        $countDelete = 0;
        foreach ($selects as $select) {
            $modelDirector->load($select);
            $modelDirector->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Director', $countDelete));
        return $resultRedirect->setPath('movie/director/show');
    }
}
