<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Block\Adminhtml\Items\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Data\FormFactory $formFactory,  
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig, 
        array $data = []
    ) 
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Catalog Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Catalog Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_aks_customcatalog_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Catalog Information')]);
        if ($model->getId()) {
            $fieldset->addField('customcatalog_id', 'hidden', ['name' => 'customcatalog_id']);
        }
        $fieldset->addField(
            'product_id',
            'text',
            ['name' => 'product_id', 'label' => __('ProductId'), 'title' => __('ProductId'), 'required' => true, 'readonly' => true]
        );

        $fieldset->addField(
            'product_sku',
            'text',
            ['name' => 'sku', 'label' => __('SKU'), 'title' => __('Sku'), 'required' => true , 'readonly' => true]
        );

        $fieldset->addField(
            'vpn',
            'text',
            ['name' => 'vpn', 'label' => __('Vpn'), 'title' => __('Vpn'), 'required' => true]
        );

        $fieldset->addField(
            'copy_write_info',
            'text',
            ['name' => 'copy_write_info', 'label' => __('Copy Write Info'), 'title' => __('Copy Write Info'), 'required' => true]
        );
        
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
