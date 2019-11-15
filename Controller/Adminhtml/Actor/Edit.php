<?php


namespace Magenest\Movie\Controller\Adminhtml\Actor;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    private $_actorModelFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magenest\Movie\Model\ActorFactory $actorModelFactory
    ) {

        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_actorModelFactory = $actorModelFactory;
    }
    public function execute()
    {
        $modelActor = $this->_actorModelFactory->create();
        if(isset($this->_request->getParams()['actor_id']))
        {
            $modelActor->load($this->_request->getParam('actor_id'));
            $Name = $this->_request->getParam('name');
            $modelActor->setName($Name);
            $modelActor->save();
            return $this->_redirect('movie/actor/show');
        }
        if(!isset($this->_request->getParams()['id']))
            return $this->_redirect('movie/actor/add');
        else
        {
            $id = $this->_request->getParam('id');
            $count = count($modelActor->load($id)->getData());
            if($count == 0)
                return $this->_redirect('movie/actor/add');
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}