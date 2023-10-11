<?php
namespace Chandan\Distributor\Controller\Adminhtml\Distributor;

use Chandan\Distributor\Model\DistributorFactory;
use Magento\Framework\Controller\Result\RedirectFactory;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::distributor_delete';

    const PAGE_TITLE = 'Page Title';

    /**
     * @var Chandan\Distributor\Model\DistributorFactory
     */
    protected $_distributor;

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
        DistributorFactory $distributor
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_distributor = $distributor;
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
        $distributorModel = $this->_distributor->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $distributor = $distributorModel->load($id);
                $distributor->delete();
                $this->messageManager->addSuccessMessage(__('Distributor Deleted Successfuly.'));
                return $resultRedirect->setPath('*/*/');

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        $this->messageManager->addErrorMessage(__('We can\'t find a Distributor to delete.'));
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
