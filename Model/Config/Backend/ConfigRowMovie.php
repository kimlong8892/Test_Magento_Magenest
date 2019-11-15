<?php


namespace Magenest\Movie\Model\Config\Backend;

class ConfigRowMovie extends \Magento\Framework\App\Config\Value
{
    private $objectManager;

    public function __construct()
    {
        $this->objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }
    public function _afterLoad()
    {

        $data = $this->objectManager->create('\Magenest\Movie\Model\ResourceModel\Movie\Collection');
        $row = count($data->getData());
        $this->setValue($row);
    }
}