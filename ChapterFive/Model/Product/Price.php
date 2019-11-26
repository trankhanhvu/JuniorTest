<?php
namespace Magenest\ChapterFive\Model\Product;
class Price extends \Magento\Catalog\Model\Product\Type\Price
{
    public function getPrice($product)
    {
        return $product->getData('price');
    }
}