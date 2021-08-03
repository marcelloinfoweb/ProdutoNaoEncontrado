<?php

namespace Funarbe\CheckoutCustomField\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveCustomFieldsInOrder implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        $order->setData('caso_produto_nao_encontrado', $quote->getCasoProdutoNaoEncontrado());

        return $this;
    }
}
