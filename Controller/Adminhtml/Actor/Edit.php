<?php

namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magenest\Movie\Model\ActorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
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
        $modelActor = $this->_actorModelFactory->create();
        if (isset($this->_request->getParams()['actor_id'])) {
            $modelActor->load($this->_request->getParam('actor_id'));
            $Name = $this->_request->getParam('name');
            $modelActor->setName($Name);
            $modelActor->save();
            return $this->_redirect('movie/actor/show');
        }
        if (!isset($this->_request->getParams()['id'])) {
            return $this->_redirect('movie/actor/add');
        } else {
            $id = $this->_request->getParam('id');
            $count = count($modelActor->load($id)->getData());
            if ($count == 0) {
                return $this->_redirect('movie/actor/add');
            }
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
