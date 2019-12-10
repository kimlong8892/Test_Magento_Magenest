<?php

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magenest\Movie\Model\ActorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends Action
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
        if (isset($this->_request->getParams()['id'])) {
            return $this->_redirect('movie/actor/add');
        }
        if (isset($this->_request->getParams()['name'])) {
            $modelActor = $this->_actorModelFactory->create();
            $Name = $this->_request->getParam('name');
            $modelActor->setName($Name);
            $modelActor->save();
            return $this->_redirect('movie/actor/show');
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
