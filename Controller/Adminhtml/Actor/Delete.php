<?php


namespace Magenest\Movie\Controller\Adminhtml\Actor;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends \Magento\Backend\App\Action
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
        $selects = $this->_request->getParam('selected');
        $modelActor = $this->_actorModelFactory->create();
        $countDelete = 0;
        foreach($selects as $select)
        {
            $modelActor->load($select);
            $modelActor->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Actor', $countDelete));
        return $resultRedirect->setPath('movie/actor/show');
    }
}