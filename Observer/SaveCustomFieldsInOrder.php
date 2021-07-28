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

        $order->setData('custom_field_text', $quote->getCustomFieldText());

        return $this;
    }
}
