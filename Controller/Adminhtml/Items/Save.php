<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Controller\Adminhtml\Items;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Aks\CustomCatalog\Model\CustomCatalog
     */
    private $customCatalogModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Aks\CustomCatalog\Model\CustomCatalog
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Aks\CustomCatalog\Model\CustomCatalog $customCatalogModel,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->customCatalogModel = $customCatalogModel;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $custom_catalog_model = $this->customCatalogModel;
                $data = $this->getRequest()->getPostValue();
                $product_id = $this->getRequest()->getParam('id');
                if ($product_id) {
                    $custom_catalog_model->load($product_id);
                    if ($product_id != $custom_catalog_model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }

                $product_model = $this->_objectManager->create('Magento\Catalog\Model\Product')->load($data['product_id']);
                $product_model->setCopywriteinfo($data['copy_write_info']);
                $product_model->setVpn($data['vpn']);
                $product_model->save();

                $custom_catalog_model->setData($data);

                $session = $this->_objectManager->get('Magento\Backend\Model\Session');
                $session->setPageData($custom_catalog_model->getData());
                $custom_catalog_model->save();
                $this->messageManager->addSuccess(__('You saved the Catalog.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('aks_customcatalog/*/edit', ['id' => $custom_catalog_model->getId()]);
                    return;
                }
                $this->_redirect('aks_customcatalog/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('aks_customcatalog/*/edit', ['id' => $product_id]);
                } else {
                    $this->_redirect('aks_customcatalog/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the item data. Please review the error log.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('aks_customcatalog/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('aks_customcatalog/*/');
    }
}
