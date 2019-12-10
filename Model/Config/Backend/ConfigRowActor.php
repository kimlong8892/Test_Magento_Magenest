<?php

namespace Magenest\Movie\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\App\ObjectManager;

class ConfigRowActor extends Value
{
    private $objectManager;

    public function __construct()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    public function _afterLoad()
    {
        $data = $this->objectManager->create('\Magenest\Movie\Model\ResourceModel\Actor\Collection');
        $row = count($data->getData());
        $this->setValue($row);
    }
}
