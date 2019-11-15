<?php


namespace Magenest\Movie\Model\Movie;


class Options implements \Magento\Framework\Data\OptionSourceInterface
{
    private $_dirCollectionFacory;
    public function __construct(
        \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $dirCollectionFacory
    )
    {
        $this -> _dirCollectionFacory = $dirCollectionFacory;
    }

    public function toOptionArray()
    {
        $dirList = $this->_dirCollectionFacory->create()->getData();

        $data = [];
        foreach ($dirList as $dir)
        {
            $data[] = [
                'value' => $dir['director_id'],
                'label' => $dir['name']
            ];
        }


        return $data;
    }
}