<?php


namespace Magenest\Movie\Setup;
use Magento\Catalog\Model\Product;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;


class UpgradeData implements UpgradeDataInterface {

    protected $customerSetupFactory;
    protected $_customerSetupAddAttribute;
    private $attributeSetFactory;

    private $eavSetupFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }


    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context )
    {

        if (version_compare($context->getVersion(), '2.5.0') < 0) {

            $setup->startSetup();
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

            $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
            $attributeSetId = $customerEntity->getDefaultAttributeSetId();

            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'avatar', [
                'type' => 'text',
                'label' => 'avatar',
                'input' => 'image',
                'required' => false,
                'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                'default' => '0',
                'visible' => true,
                'user_defined' => true,
                'sort_order' => 210,
                'position' => 210,
                'system' => false,
            ]);

            $image = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'avatar')
                ->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_create', 'customer_account_edit', 'checkout_register', 'adminhtml_checkout'],
                ]);
            $image->save();
            $setup->endSetup();
        }







    }


}