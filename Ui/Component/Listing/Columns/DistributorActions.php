<?php
namespace Chandan\Distributor\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;
 
class DistributorActions extends Column
{
 
    protected $_searchCriteria;
    protected $_urlBuilder;
    
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SearchCriteriaBuilder $criteria,
        array $components = [],
        array $data = [],
        UrlInterface $urlBuilder
    ) {
        $this->_searchCriteria  = $criteria;
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
 
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->_urlBuilder->getUrl('erp/distributor/edit', ['id' => $item['id']]),
                    'label' => __('Edit'),
                    'hidden' => false
                ];

                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->_urlBuilder->getUrl('erp/distributor/delete', ['id' => $item['id']]),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Confirmation?'),
                        'message' => __('Are you sure you wan\'t to delete this record?')
                    ],
                    'hidden' => false
                ];
            }
        }
        return $dataSource;
    }
}
