<?php

namespace Chandan\Distributor\Model\Cache;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Cache\Type\FrontendPool;
use Magento\Framework\Cache\Frontend\Decorator\TagScope;

class DistributorType extends TagScope
{
    /**
     * Type Code for Cache. It should be unique
     */
    const TYPE_IDENTIFIER = 'distributor';
    /**
     * Tag of Cache
     */
    const CACHE_TAG = 'DISTRIBUTOR';

    protected $_cache;

    private $cacheFrontendPool;

    /**
     * @param \Magento\Framework\App\Cache\Type\FrontendPool $cacheFrontendPool
     */
    public function __construct(
        FrontendPool $cacheFrontendPool,
        CacheInterface $cache
    ) {
        $this->_cache = $cache;
        parent::__construct(
            $cacheFrontendPool->get(self::TYPE_IDENTIFIER),
            self::CACHE_TAG
        );
    }
}
