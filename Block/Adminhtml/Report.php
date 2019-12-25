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
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollectionFacory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFacory,
        \Magento\Reports\Model\ResourceModel\Customer\Orders\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditmemoCollectionFactory,
        Template\Context $context, array $data = []
    )
    {
        $this->fullModuleList = $fullModuleList;
        $this->customerCollectionFacory = $customerCollectionFacory->create();
        $this->productCollectionFactory = $productCollectionFacory->create();
        $this->orderCollectionFactory = $orderCollectionFactory->create();
        $this->invoiceCollectionFactory = $invoiceCollectionFactory->create();
        $this->creditmemoCollectionFactory = $creditmemoCollectionFactory->create();
        parent::__construct($context, $data);
    }

    public function CountAllModule()
    {
        return count($this->fullModuleList->getAll());
    }

    public function countCustomer()
    {
        return $this->customerCollectionFacory->count();
    }

    public function countProduct()
    {
        return $this->productCollectionFactory->count();
    }

    public function countOrder()
    {
        return $this->orderCollectionFactory->count();
    }

    public function countInvoice()
    {
        return $this->invoiceCollectionFactory->count();
    }

    public function countCreditmemo()
    {
        return $this->creditmemoCollectionFactory->count();
    }

    public function countModuleNotMagento()
    {
        $count = 0;
        $datas = $this->fullModuleList->getNames();
        forEach($datas as $data)
        {
            if(!preg_match("/Magento_/", $data))
                $count++;
        }
        return $count;
    }
}