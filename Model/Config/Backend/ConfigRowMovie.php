<?php

namespace Magenest\Movie\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\App\ObjectManager;

class ConfigRowMovie extends Value
{
    private $objectManager;

    public function __construct()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    public function _afterLoad()
    {
        $data = $this->objectManager->create('\Magenest\Movie\Model\ResourceModel\Movie\Collection');
        $row = count($data->getData());
        $this->setValue($row);
    }
}
