<?php


namespace Magenest\Movie\Observer;
use Magento\Framework\Event\ObserverInterface;

class DefaultRatingMovie implements ObserverInterface
{
    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    private $_modelMovieFactory;
    public function __construct
    (
        \Psr\Log\LoggerInterface $logger,
        \Magenest\Movie\Model\MovieFactory $modelMovieFactory
    )
    {
        $this->logger = $logger;
        $this->_modelMovieFactory = $modelMovieFactory;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $idMovie = $observer -> getId();
        $movieModel = $this->_modelMovieFactory->create()->load($idMovie);
        $movieModel->setRating(0);
        $movieModel->save();


    }
}