<?php
namespace Chandan\Distributor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Distributor extends AbstractDb
{
    const TABLE = 'distributor';
    const PRIMERY_KEY = 'id';
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE, self::PRIMERY_KEY);
    }
}
