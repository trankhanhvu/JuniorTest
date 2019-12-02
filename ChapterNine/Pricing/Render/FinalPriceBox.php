<?php

namespace Magenest\ChapterNine\Pricing\Render;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    protected $scopeConfig;
    public function __construct(Context $context, SaleableInterface $saleableItem, PriceInterface $price, RendererPool $rendererPool, array $data = [], SalableResolverInterface $salableResolver = null, MinimalPriceCalculatorInterface $minimalPriceCalculator = null,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
    }

    protected function wrapResult($html)
    {
        $hide = $this->scopeConfig->getValue('catalog/price/hideprice', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');

        if ($hide == 1)
        {
            if ($customerSession->isLoggedIn())
                return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                    'data-role="priceBox" ' .
                    'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                    'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                    '>' . $html . '</div>';
            else
                return '';
        }
        else
            return '<div class="price-box ' . $this->getData('css_classes') . '" ' .
                'data-role="priceBox" ' .
                'data-product-id="' . $this->getSaleableItem()->getId() . '" ' .
                'data-price-box="product-id-' . $this->getSaleableItem()->getId() . '"' .
                '>' . $html . '</div>';
    }

}