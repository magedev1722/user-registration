<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Model;

use Magento\Framework\Model\AbstractModel;

class CustomCatalog extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_blog('lrb\CustomCatalog\Model\ResourceModel\CustomCatalog');
    }
}
