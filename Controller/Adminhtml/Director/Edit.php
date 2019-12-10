<?php

namespace Magenest\Movie\Controller\Adminhtml\Director;

use Magenest\Movie\Model\DirectorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
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
        $modelDirector = $this->_directorModelFactory->create();
        if (isset($this->_request->getParams()['director_id'])) {
            $modelDirector->load($this->_request->getParam('director_id'));
            $Name = $this->_request->getParam('name');
            $modelDirector->setName($Name);
            $modelDirector->save();
            return $this->_redirect('movie/director/show');
        }
        if (!isset($this->_request->getParams()['id'])) {
            return $this->_redirect('movie/director/add');
        } else {
            $id = $this->_request->getParam('id');
            $count = count($modelDirector->load($id)->getData());
            if ($count == 0) {
                return $this->_redirect('movie/director/add');
            }
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
