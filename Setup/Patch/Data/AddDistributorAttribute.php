<?php
namespace Chandan\Distributor\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Chandan\Distributor\Model\Source\Config\DistributorList;
use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;

class AddDistributorAttribute implements DataPatchInterface, PatchVersionInterface
{

    /**
     * To create product attribute EavSetupFactory class is used.
     * @var Magento\Eav\Setup\EavSetupFactory
     */
    private $_eavSetupFactory;


    /**
     * @var ModuleDataSetupInterface
     */
    private $_moduleDataSetup;

    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * PatchInitial constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->_moduleDataSetup = $moduleDataSetup;
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function apply()
    {
       
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $this->_moduleDataSetup]);
        $eavSetup->addAttribute(Product::ENTITY, 'distributor_id', [
            'type' => 'int',
            'backend' => '',
            'frontend' => '',
            'label' => 'Select Distributor',
            'input' => 'select',
            'class' => '',
            'source' => DistributorList::class,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => false,
            'default' => '0',
            'searchable' => true,
            'filterable' => true,
            'comparable' => true,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'unique' => false
        ]);
        
        
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.1';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}