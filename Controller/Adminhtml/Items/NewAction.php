<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Controller\Adminhtml\Items;

class NewAction extends \Aks\CustomCatalog\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
