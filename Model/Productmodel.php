<?php
/**
 * @category  Aks CustomCatalog
 * @package   Aks_CustomCatalog
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */

namespace Aks\CustomCatalog\Model;

use Aks\CustomCatalog\Api\ProductInterface;
 
class productmodel implements ProductInterface
{

    private $publisher;
    /**
     * @param \Magento\Framework\MessageQueue\PublisherInterface $publisher
     */
    public function __construct(\Magento\Framework\MessageQueue\PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }
    
    /**
     * Set product_id
     * @param string $product_id
     * @return \Aks\CustomCatalog\Api\ProductInterface
     */
    public function updateProduct() {

        try {
            $params = (array) json_decode(file_get_contents('php://input'), TRUE);

            $this->publisher->publish('customcatalog.product.update', json_encode($params));
            $result = ['msg' => 'Your Request is added to RabbitMQ'];
            return $result;
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage()];
            return $result;
        }
    }

}