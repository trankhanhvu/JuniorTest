<?php

namespace Magenest\ChapterSeven\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddToCart implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    protected $_request;

    protected $date;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->_request = $request;
        $this->date = $date;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $time = time();

        // Check and set information according to your need
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $product = $observer->getProduct();
            $additionalOptions = [];
            $additionalOptions[] = array(
                'label' => "Time Stamp",
                'value' => $time
            );
            $observer->getProduct()->addCustomOption('additional_options', json_encode($additionalOptions));
        }
    }
}