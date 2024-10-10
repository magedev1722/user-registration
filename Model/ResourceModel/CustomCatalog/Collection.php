<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Model\ResourceModel\CustomCatalog;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'customcatalog_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Aks\CustomCatalog\Model\CustomCatalog',
            'Aks\CustomCatalog\Model\ResourceModel\CustomCatalog'
        );
    }
}