<?php

namespace Funarbe\CheckoutCustomField\Plugin\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LayoutProcessorPlugin
{
    /**
     * @param LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(LayoutProcessor $subject, array $jsLayout): array
    {

        $customField = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'options' => [
                    [
                        'value' => 'Ligar',
                        'label' => 'Ligar',
                    ],
                    [
                        'value' => 'Substituir',
                        'label' => 'Substituir',
                    ],
                    [
                        'value' => 'Retirar',
                        'label' => 'Retirar',
                    ]
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes.custom_field_text',
            'label' => 'O que fazer se o produto não estiver disponível?',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ]
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['before-form']['children']['custom_field_text'] = $customField;

        return $jsLayout;
    }
}
