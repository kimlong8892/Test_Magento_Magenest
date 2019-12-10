<?php

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magenest\Movie\Model\ActorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    private $_actorModelFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ActorFactory $actorModelFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_actorModelFactory = $actorModelFactory;
    }

    public function execute()
    {
        $selects = $this->_request->getParam('selected');
        $modelActor = $this->_actorModelFactory->create();
        $countDelete = 0;
        foreach ($selects as $select) {
            $modelActor->load($select);
            $modelActor->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Actor', $countDelete));
        return $resultRedirect->setPath('movie/actor/show');
    }
}
