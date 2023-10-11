<?php
namespace Chandan\Distributor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class DistributorShopProducts extends AbstractDb
{
    const TABLE = "distributor_shop_products";
    const PRIMERY_KEY ="id";
    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMERY_KEY);
    }
}
