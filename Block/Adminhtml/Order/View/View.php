<?php

namespace Funarbe\ProdutoNaoEncontrado\Block\Adminhtml\Order\View;

use Magento\Framework\App\ResourceConnection;

class View extends \Magento\Backend\Block\Template
{

    public function getCasoProdutoNaoEncontrar()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('sales_order'); //gives table name with prefix
        $orderId = $this->_request->getParam('order_id');
        //Select Data from table
        $sql = "Select caso_produto_nao_encontrado FROM " . $tableName . " WHERE entity_id = " .$orderId;
        return $connection->fetchOne($sql); // gives associated array, table fields as key in array.


//        $orderId = $this->_request->getParam('order_id');
//        $tableName = $this->getTableName('sales_order');
//
//        $query = 'SELECT caso_produto_nao_encontrado FROM ' . $tableName;


//        return $this->resourceConnection->getConnection()->fetchOne($query);
    }
}
