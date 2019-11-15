<?php


namespace Magenest\Movie\Controller\Adminhtml\Director;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    private $_directorModelFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magenest\Movie\Model\DirectorFactory $directorModelFactory
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
        foreach($selects as $select)
        {
            $modelDirector->load($select);
            $modelDirector->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Director', $countDelete));
        return $resultRedirect->setPath('movie/director/show');
    }
}