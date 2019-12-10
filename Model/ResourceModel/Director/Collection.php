<?php


namespace Magenest\Movie\Model\ResourceModel\Director;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Magenest\Movie\Model\Director',
            'Magenest\Movie\Model\ResourceModel\Director');
    }
}