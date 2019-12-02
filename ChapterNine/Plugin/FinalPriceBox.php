<?php

namespace Magenest\ChapterNine\Plugin;

class FinalPriceBox
{
    function aroundToHtml($subject, callable $proceed)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');

        if($customerSession->isLoggedIn()){
            return $proceed();
        }else{
            return '';
        }

    }
}
