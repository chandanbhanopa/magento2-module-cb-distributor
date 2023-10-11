<?php
namespace Chandan\Distributor\Controller\Adminhtml\Distributor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::distributorlist';

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__('Distributor List'));
        return $resultPage;
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
