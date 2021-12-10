<?php

namespace Funarbe\ProdutoNaoEncontrado\Block\Adminhtml\Order\View;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template;

class View extends Template
{

    public function getCasoProdutoNaoEncontrar(): string
    {
        // Instance of object manager
        $resource = ObjectManager::getInstance()->get(ResourceConnection::class);
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('sales_order');
        $orderId = $this->_request->getParam('order_id');
        //Select Data from table
        $sql = "Select caso_produto_nao_encontrado FROM " . $tableName . " WHERE entity_id = " .$orderId;

        return $connection->fetchOne($sql);


//        $orderId = $this->_request->getParam('order_id');
//        $tableName = $this->getTableName('sales_order');
//
//        $query = 'SELECT caso_produto_nao_encontrado FROM ' . $tableName;


//        return $this->resourceConnection->getConnection()->fetchOne($query);
    }
}
