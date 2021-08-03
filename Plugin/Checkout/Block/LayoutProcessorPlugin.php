<?php

namespace Funarbe\CheckoutCustomField\Plugin\Checkout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
 * LayoutProcessorPlugin
 */
class LayoutProcessorPlugin
{
    /**
     * Custom checkot Field
     *
     * @param  LayoutProcessor $subject
     * @param  array           $jsLayout
     * @return array
     */
    public function afterProcess(LayoutProcessor $subject, array $jsLayout): array
    {
        $customField = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'template' => 'ui/form/field',
                'elementTmpl' => 'Funarbe_CheckoutCustomField/radio',
                'options' => [
                    [
                        'value' => 'Ligar',
                        'label' => 'Ligar',
                        'name' => 'opcao-produto'
                    ],
                    [
                        'value' => 'Substituir',
                        'label' => 'Substituir',
                        'name' => 'opcao-produto'

                    ],
                    [
                        'value' => 'Retirar',
                        'label' => 'Retirar',
                        'name' => 'opcao-produto'

                    ]
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes.caso_produto_nao_encontrado',
            // 'label' => 'O que fazer se o produto não estiver disponível?',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 10,
            'validation' => [
                'required-entry' => true
            ]
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']
        ['shipping-step']['children']['shippingAddress']['children']['before-form']
        ['children']['caso_produto_nao_encontrado'] = $customField;

        return $jsLayout;
    }
}
