<?php

namespace Chandan\Distributor\Ui\Shop;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Chandan\Distributor\Model\ResourceModel\DistributorShop\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    private $loadedData;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var CollectionFactory
     */
    
    public $collection;

    /**
     * DataProvider constructor.
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }


        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
        }
        $data = $this->dataPersistor->get('shop_data');
        
        
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('shop_data');
        }
        
        return $this->loadedData;
    }
}
