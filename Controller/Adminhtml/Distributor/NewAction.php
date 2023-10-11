<?php
namespace Chandan\Distributor\Controller\Adminhtml\Distributor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::distributornew';
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $forwardFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ForwardFactory $forwardFactory
    ) {
        $this->pageFactory = $pageFactory;
        $this->forwardFactory =$forwardFactory;
        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return Page
     */
    public function execute()
    {
        $resultForward = $this->forwardFactory->create();
        return $resultForward->forward('edit');
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
