<?php
namespace Chandan\Distributor\Model\ResourceModel\DistributorShop;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Chandan\Distributor\Model\DistributorShop::class, \Chandan\Distributor\Model\ResourceModel\DistributorShop::class);
    }
}
