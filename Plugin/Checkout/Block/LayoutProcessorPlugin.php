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
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'custom-field-text'
            ],
            'dataScope' => 'shippingAddress.custom_attributes.custom_field_text',
            'label' => 'Custom Field Text',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [
                'required-entry' => true
            ],
            'sortOrder' => 250,
            /*'customEntry' => null,*/
            'id' => 'custom-field-text'
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['before-form']['children']['custom_field_text'] = $customField;

        return $jsLayout;
    }
}
