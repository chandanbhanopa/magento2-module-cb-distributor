<?php
namespace Chandan\Distributor\Controller\Adminhtml\Shop;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Chandan\Distributor\Model\DistributorShopFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class Index
 * @package Chandan\Distributor\Controller\Adminhtml\Distributor\Save
 */
class Save extends Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::shop_save';
    
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * [$resultRedirectFactory description]
     * @var Magento\Framework\Controller\ResultFactory
     */
    protected $resultRedirectFactory;

    /**
     * [$questionFactory description]
     * @var Chandan\Distributor\Model\DistributorShopFactory
     */
    private $distributorShop;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $rawFactory
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        ResultFactory $resultRedirectFactory,
        DistributorShopFactory $distributorShop,
        DataPersistorInterface $dataPersistor
    ) {
        $this->pageFactory = $rawFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->distributorShop = $distributorShop;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }
    
    /**
     * Add the main Admin Grid page
     *
     * @return Page
     */
    public function execute()
    {
        
        $resultRedirect = $this->resultRedirectFactory->create();
        $distributorShop = $this->distributorShop->create();
        $data = $this->getRequest()->getPostValue();
        $this->dataPersistor->set('shop_data', $data);
        try {
            if ($id = (int) $this->getRequest()->getParam('id')) {
                $distributorShop = $distributorShop->load($id);
                if ($id != $distributorShop->getId()) {
                    $this->messageManager->addErrorMessage(__('This Shop no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $distributorShop->setData($data);
            $distributorShop->save();
            if ($distributorShop->getId()) {
                $this->messageManager->addSuccessMessage(__('Distributor Created Successfuly'));
            }
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $distributorShop->getId()]);
            }
            $this->dataPersistor->clear('shop_data');
            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
             $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the distributor.'));
        }
        
        return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
