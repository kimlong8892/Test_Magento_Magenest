<?php


namespace Magenest\Movie\Controller\Adminhtml\Director;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Backend\App\Action
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

        if(isset($this->_request->getParams()['id']))
            return $this->_redirect('movie/director/add');
        if(isset($this->_request->getParams()['name']))
        {
            $modelDirector = $this->_directorModelFactory->create();
            $Name = $this->_request->getParam('name');
            $modelDirector->setName($Name);
            $modelDirector->save();
            return $this->_redirect('movie/director/show');
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}