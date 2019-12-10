<?php


namespace Magenest\Movie\Plugin\Catalog;


class ChangeNameProductChild
{
    protected $_storeManager;

    public function __construct
    (
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        $this->_storeManager = $storeManager;
    }

    public function aroundGetItemData($subject, $proceed, $item)
    {
        $result = $proceed($item);
        if ($item->getData('is_virtual') == "1") {
            $result['product_name'] = $item->getChildren()[0]['name'];
            $result['product_image']['src'] = $this->_storeManager->getStore()->getBaseUrl() . "/pub/media/catalog/product" . $item->getChildren()[0]->getProduct()['thumbnail'];
        }
        return $result;
    }


}