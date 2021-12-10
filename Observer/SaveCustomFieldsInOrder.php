<?php

namespace Funarbe\ProdutoNaoEncontrado\Observer;

class SaveCustomFieldsInOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData('caso_produto_nao_encontrado', $quote->getCasoProdutoNaoEncontrado());

        return $this;
    }
}
