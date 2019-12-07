<?php


namespace Magenest\Movie\Block\Adminhtml;
use Magento\Framework\View\Element\Template;


class Report extends Template
{
    protected $fullModuleList;
    protected $customerCollectionFacory;
    protected $productCollectionFactory;
    protected $orderCollectionFactory;
    protected $invoiceCollectionFactory;
    protected $creditmemoCollectionFactory;
    public function __construct
    (
        Template\Context $context, array $data = [],
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFacory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFacory,
        \Magento\Reports\Model\ResourceModel\Customer\Orders\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditmemoCollectionFactory

    )
    {
        $this->fullModuleList = $fullModuleList;
        $this->customerCollectionFacory = $customerCollectionFacory;
        $this->productCollectionFactory = $productCollectionFacory;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->invoiceCollectionFactory = $invoiceCollectionFactory;
        $this->creditmemoCollectionFactory = $creditmemoCollectionFactory;
        parent::__construct($context, $data);
    }
    public function CountAllModule()
    {
        return count($this->fullModuleList->getAll());
    }
    public function countCustomer()
    {
        return count($this->customerCollectionFacory->create()->getData());
    }
    public function countProduct()
    {
        return count($this->productCollectionFactory->create()->getData());
    }
    public function countOrder()
    {
        return count($this->orderCollectionFactory->create()->getData());
    }
    public function countInvoice()
    {
        return count($this->invoiceCollectionFactory->create()->getData());
    }
    public function countCreditmemo()
    {
        return count($this->creditmemoCollectionFactory->create()->getData());
    }
    public function countModuleNotMagento()
    {
        $count = 0;
        $datas =  $this->fullModuleList->getAll();
        forEach($datas as $data)
        {
            if(strlen($data['name']) <= 7)
                $count++;
            else if(substr($data['name'], 0, 7) != "Magento")
                    $count++;
        }
        return $count;
    }
}