<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Controller\Adminhtml\Items;

class Edit extends \Aks\CustomCatalog\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        
        $catalog_model = $this->_objectManager->create('Aks\CustomCatalog\Model\CustomCatalog');

        if ($id) {
            $catalog_model->load($id);
            if (!$catalog_model->getId()) {
                $this->messageManager->addError(__('This Catalog no longer exists.'));
                $this->_redirect('aks_customcatalog/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $catalog_model->addData($data);
        }
        $this->_coreRegistry->register('current_aks_customcatalog_items', $catalog_model);
        $this->_initAction();
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
