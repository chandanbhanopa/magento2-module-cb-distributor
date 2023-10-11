<?php
namespace Chandan\Distributor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DistributorShop extends AbstractDb
{
    const TABLE = "distributor_shop";
    const PRIMERY_KEY ="id";
    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMERY_KEY);
    }
}
