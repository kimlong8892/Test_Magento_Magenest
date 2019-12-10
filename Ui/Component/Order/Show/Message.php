<?php

namespace Magenest\Movie\Ui\Component\Order\Show;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Message extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                if ((int)$items['increment_id'] % 2 != 0) {
                    $items['Message'] = '<span class="grid-severity-critical">ERROR</span>';
                } else {
                    $items['Message'] = '<span class="grid-severity-notice">SUCCESS</span>';
                }
            }
        }
        return $dataSource;
    }
}
