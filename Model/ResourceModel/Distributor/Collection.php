<?php
namespace Chandan\Distributor\Model\ResourceModel\Distributor;

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
        $this->_init(\Chandan\Distributor\Model\Distributor::class, \Chandan\Distributor\Model\ResourceModel\Distributor::class);
    }
}
