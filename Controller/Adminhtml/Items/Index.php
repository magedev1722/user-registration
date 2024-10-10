<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Controller\Adminhtml\Items;

class Index extends \Aks\CustomCatalog\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Aks_CustomCatalog::customcatalog');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Catalog'));
        $resultPage->addBreadcrumb(__('Custom Catalog'), __('CustomCatalog'));
        $resultPage->addBreadcrumb(__('Custom Catalog'), __('CustomCatalog'));
        return $resultPage;
    }
}