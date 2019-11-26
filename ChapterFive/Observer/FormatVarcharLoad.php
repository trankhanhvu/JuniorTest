<?php
namespace Magenest\ChapterFive\Observer;
use Magento\Framework\Event\ObserverInterface;
class FormatVarcharLoad implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getProduct();
        $magenest_varchar = explode(' ',$product->getData('magenest_varchar'));
        $product->setData('magenest_varchar',$magenest_varchar[0]);
    }
}