<?php
namespace Magenest\ChapterFive\Observer;
use Magento\Framework\Event\ObserverInterface;
class FormatVarchar implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();
        $magenest_varchar = $product->getData('magenest_varchar');
        $product->setData('magenest_varchar',$magenest_varchar . ' varchar(' . strlen($magenest_varchar) . ")");
    }
}