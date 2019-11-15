<?php


namespace Magenest\Movie\Controller\Adminhtml\Movie;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    private $_movieModelFactory;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Magenest\Movie\Model\MovieFactory $movieModelFactory
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
        foreach($selects as $select)
        {
            $modelMovie->load($select);
            $modelMovie->delete();
            $countDelete++;
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $this->messageManager->addSuccess(__('Delete Success %1 Movie', $countDelete));
        return $resultRedirect->setPath('movie/movie/show');
    }
}