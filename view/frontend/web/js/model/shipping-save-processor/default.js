/*global define*/
define([
        'jquery',
        'ko',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/resource-url-manager',
        'mage/storage',
        'Magento_Checkout/js/model/payment-service',
        'Magento_Checkout/js/model/payment/method-converter',
        'Magento_Checkout/js/model/error-processor',
        'Magento_Checkout/js/model/full-screen-loader',
    ], function (
        $,
        ko,
        quote,
        resourceUrlManager,
        storage,
        paymentService,
        methodConverter,
        errorProcessor,
        fullScreenLoader
    ) {
        'use strict';
        return {
            saveShippingInformation: function () {
                $('body').trigger('processStart');
                let deliveryfee = $('[name="custom-fee"]').val();
                if (!deliveryfee) {
                    deliveryfee = 0;
                }

                const casoProdutoNaoEncontrado = $('input[name="opcao-produto"]:checked').val();

                if (!casoProdutoNaoEncontrado) {
                    fullScreenLoader.stopLoader()
                    $('.message.notice').hide()
                    $('.mensagem-erro').html(
                        '<div role="alert" class="message notice">\n' +
                        '   <span>Marque uma das opções acima.</span>\n' +
                        '</div>')
                    return false
                }

                let deliveryCall = 0;
                if ($('[name="delivery_call"]').prop("checked") === true) {
                    deliveryCall = 1;
                } else {
                    deliveryCall = 0;
                }

                const payload = {
                    addressInformation: {
                        shipping_address: quote.shippingAddress(),
                        shipping_method_code: quote.shippingMethod().method_code,
                        shipping_carrier_code: quote.shippingMethod().carrier_code,
                        extension_attributes: {
                            delivery_date: $('[name="delivery_date"]').val(),
                            delivery_timeslot: $('[name="delivery_timeslot"]').val(),
                            delivery_comment: $('[name="delivery_comment"]').val(),
                            delivery_call: deliveryCall,
                            fee: deliveryfee,
                            caso_produto_nao_encontrado: casoProdutoNaoEncontrado,
                        }
                    }
                };

                return storage.post(
                    resourceUrlManager.getUrlForSetShippingInformation(quote),
                    JSON.stringify(payload)
                ).done(
                    function (response) {
                        $('body').trigger('processStop');
                        quote.setTotals(response.totals);
                        paymentService.setPaymentMethods(methodConverter(response.payment_methods));
                        fullScreenLoader.stopLoader();
                    }
                ).fail(
                    function (response) {
                        $('body').trigger('processStop');
                        errorProcessor.process(response);
                        fullScreenLoader.stopLoader();
                    }
                );
            }
        };
    }
);
