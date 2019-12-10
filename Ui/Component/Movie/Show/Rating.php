<?php

namespace Magenest\Movie\Ui\Component\Movie\Show;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Rating extends Column
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
                $rating = $items['rating'];
                $items['rating'] = '';
                $items['rating'] .= '<div class="field-summary-rating"><div class="rating-box">';
                $items['rating'] .= '<div class="rating" style="width:' . $rating . '%;"></div>';
                $items['rating'] .= '</div></div>';
            }
        }
        return $dataSource;
    }
}
