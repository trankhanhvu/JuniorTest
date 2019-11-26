<?php

namespace Magenest\ChapterFive\Model\Product\Type;

class NewProductType extends \Magento\Catalog\Model\Product\Type\Virtual
{
    /**
     * Product-type code
     */
    const TYPE_CODE = 'new_product_type';

    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {
    }
}