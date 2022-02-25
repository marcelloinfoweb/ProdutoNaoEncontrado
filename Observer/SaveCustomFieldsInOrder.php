<?php

namespace Funarbe\ProdutoNaoEncontrado\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveCustomFieldsInOrder implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(Observer $observer): SaveCustomFieldsInOrder
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData('caso_produto_nao_encontrado', $quote->getCasoProdutoNaoEncontrado());

        return $this;
    }
}
