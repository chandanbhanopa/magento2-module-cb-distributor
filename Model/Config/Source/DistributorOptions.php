<?php
namespace Chandan\Distributor\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Chandan\Distributor\Model\ResourceModel\Distributor\CollectionFactory;

class DistributorOptions implements ArrayInterface
{
    /**
     * @var Chandan\Distributor\Model\ResourceModel\Distributor\CollectionFactory
     */
    protected $distributorCollection;

    public function __construct(CollectionFactory $distributorCollection)
    {
        $this->distributorCollection = $distributorCollection;
    }
    public function toOptionArray()
    {
        $result = [];
        $distributorData = $this->distributorCollection->create();
        foreach ($distributorData as $key => $distributor) {
            $result[] = [
                'value' => $distributor->getId(),
                'label' => $distributor->getData('company_name'),
            ];
        }
        
        return $result;
    }
}
