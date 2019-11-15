<?php


namespace Magenest\Movie\Controller\Adminhtml\Movie;
use http\Env\Request;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Backend\App\Action
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
        if(isset($this->_request->getParams()['id']))
            return $this->_redirect('movie/movie/add');
        if(isset($this->_request->getParams()['name']))
        {
            $modelMovie = $this->_movieModelFactory->create();
            $Name = $this->_request->getParam('name');
            $Description = $this->_request->getParam('description');
            $Rating = $this->_request->getParam('rating');
            $Dir_id = $this->_request->getParam('director_id');
            $modelMovie->setName($Name);
            $modelMovie->setDescription($Description);
            $modelMovie->setRating($Rating);
            $modelMovie->setDirector_id($Dir_id);
            $modelMovie->save();
            return $this->_redirect('movie/movie/show');
        }
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}