<?php

namespace Magenest\ChapterEight\Plugin;

class ChangeNameSpecial
{
    private $productRepository;

    public function __construct(
        \Magento\Catalog\Model\ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject)
    {
        $id = $subject->getId();
        $product = $this->productRepository->getById($id);
        $orgprice = $product->getPrice();
        $specialprice = $product->getSpecialPrice();
        $specialfromdate = $product->getSpecialFromDate();
        $specialtodate = $product->getSpecialToDate();
        $today = time();

        if (!$specialprice)
            $specialprice = $orgprice;
        if ($specialprice< $orgprice) {
            if ((is_null($specialfromdate) &&is_null($specialtodate)) || ($today >= strtotime($specialfromdate) &&is_null($specialtodate)) || ($today <= strtotime($specialtodate) &&is_null($specialfromdate)) || ($today >= strtotime($specialfromdate) && $today <= strtotime($specialtodate))) {
                return "Special:" . $subject['name'];
            }
        }
        return $subject['name'];
    }
}
