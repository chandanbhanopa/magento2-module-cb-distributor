<?php
namespace Chandan\Distributor\Model;

use Magento\Framework\Model\AbstractModel;

class DistributorShop extends AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Chandan\Distributor\Model\ResourceModel\DistributorShop::class);
    }
}
