<?php


namespace Magenest\Movie\Block\Adminhtml\Form\Button;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Direct extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        return '<button onclick="location.reload(true);" type="button">' . __('Reload') . '</button>';
    }
}