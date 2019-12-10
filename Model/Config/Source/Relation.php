<?php

namespace Magenest\Movie\Model\Config\Source;
use Magento\Framework\Option\ArrayInterface;

class Relation implements ArrayInterface
{
    public function toOptionArray()
    {
        $data = [];
        $data[] = [
            'value' => 1,
            'label' => __("show")
        ];
        $data[] = [
            'value' => 2,
            'label' => __("not-show")
        ];
        return $data;
    }
}
