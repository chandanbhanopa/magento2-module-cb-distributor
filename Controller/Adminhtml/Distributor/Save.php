<?php
namespace Chandan\Distributor\Controller\Adminhtml\Distributor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Chandan\Distributor\Model\DistributorFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class Index
 * @package Chandan\Distributor\Controller\Adminhtml\Distributor\Save
 */
class Save extends Action
{
    const ADMIN_RESOURCE = 'Chandan_Distributor::distributorsave';
    
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
     * @var Chandan\Distributor\Model\DistributorFactory
     */
    private $distributorFactory;

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
        DistributorFactory $distributorFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->pageFactory = $rawFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->distributorFactory = $distributorFactory;
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
        $distributor = $this->distributorFactory->create();
        $data = $this->getRequest()->getPostValue();
        $this->dataPersistor->set('distributor_data', $data);
        
        try {
            if ($id = (int) $this->getRequest()->getParam('id')) {
                $distributor = $distributor->load($id);
                if ($id != $distributor->getId()) {
                    $this->messageManager->addErrorMessage(__('This distributor no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $distributor->setData($data);
            $distributor->save();
            if ($distributor->getId()) {
                $this->messageManager->addSuccessMessage(__('Distributor Created Successfuly'));
            }
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['id' => $distributor->getId()]);
            }
            $this->dataPersistor->clear('distributor_data');
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
