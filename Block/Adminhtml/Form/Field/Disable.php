<?php


namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Disable extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        $element->setData('readonly', 1);
        $element->setDisabled('disabled');
        return $element->getElementHtml();
    }
}