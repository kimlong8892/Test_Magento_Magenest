<?php

namespace Magenest\Movie\Model\Movie;

use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    private $_dirCollectionFacory;

    public function __construct(
        CollectionFactory $dirCollectionFacory
    ) {
        $this->_dirCollectionFacory = $dirCollectionFacory;
    }

    public function toOptionArray()
    {
        $dirList = $this->_dirCollectionFacory->create()->getData();

        $data = [];
        foreach ($dirList as $dir) {
            $data[] = [
                'value' => $dir['director_id'],
                'label' => $dir['name']
            ];
        }

        return $data;
    }
}
