<?php
namespace Chandan\Distributor\Controller\Adminhtml\Shop;

use Chandan\Distributor\Model\DistributorShopFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::shop_delete';

    const PAGE_TITLE = 'Page Title';

    /**
     * @var Chandan\Distributor\Model\DistributorShopFactory
     */
    protected $_distributorShop;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $_resultRedirectFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        RedirectFactory $resultRedirect,
        DistributorShopFactory $distributorShop
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_distributorShop = $distributorShop;
        $this->_resultRedirectFactory = $resultRedirect;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();
        $distributorShopModel = $this->_distributorShop->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $shop = $distributorShopModel->load($id);
                $shop->delete();
                $this->messageManager->addSuccessMessage(__('Shop Deleted Successfuly.'));
                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Shop to delete.'));
        return $resultRedirect->setPath('*/*/');
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
