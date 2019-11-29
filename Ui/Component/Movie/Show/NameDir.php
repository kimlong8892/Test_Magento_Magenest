<?php


namespace Magenest\Movie\Ui\Component\Movie\Show;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class NameDir extends Column
{
    private $_dirCollectionFactory;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $dirCollectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_dirCollectionFactory = $dirCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $listDir = $this->_dirCollectionFactory->create()->getData();
            foreach ($dataSource['data']['items'] as &$items) {
                foreach ($listDir as $dir)
                    if($items['director_id'] == $dir['director_id'])
                        $items['director_id'] = $dir['name'];
            }
        }
        return $dataSource;
    }
}