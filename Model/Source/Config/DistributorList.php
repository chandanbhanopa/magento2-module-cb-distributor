<?php
namespace Chandan\Distributor\Model\Source\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Chandan\Distributor\Model\ResourceModel\Distributor\CollectionFactory;


class DistributorList extends AbstractSource
{
     /**
     * @var Chandan\Distributor\Model\ResourceModel\Distributor\CollectionFactory
     */
    protected $distributorCollection;

    public function __construct(CollectionFactory $distributorCollection)
    {
        $this->distributorCollection = $distributorCollection;
    }
    public function getAllOptions()
    {
        $result = [];
        
        $distributorData = $this->distributorCollection->create();
        
        $result[] = ['label' => 'Select Distributor', 'value' => '0'];
        foreach ($distributorData as $key => $distributor) {
            $result[] = [
                'label' => $distributor->getData('company_name'),
                'value' => $distributor->getId()
            ];
        }
        return $result;
    }
}
