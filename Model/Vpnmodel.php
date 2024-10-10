<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Model;

use Aks\CustomCatalog\Api\VpnInterface;
 
class Vpnmodel implements VpnInterface
{

    /**
     * Get vpn
     * @return string
     */
    public function getVpn($vpn) {
        $data = $this->getProductByVpn($vpn);
        $result = $data->getData();
        return $result;
    }


    public function getProductByVpn($vpn)
    {
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $product = $objectManager->create('Aks\CustomCatalog\Model\CustomCatalog')->getCollection()->addFieldToFilter('vpn',$vpn);
        return $product;
    }

}