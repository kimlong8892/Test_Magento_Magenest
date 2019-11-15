<?php

namespace Magenest\Movie\Model\Config\Source;
class Relation implements \Magento\Framework\Option\ArrayInterface
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
