<?php
namespace Magenest\ChapterTwo\Block;

use Magento\Backend\Block\Template;

class Clock extends Template
{
    protected $_scopeConfig;

    public function __construct(Template\Context $context, array $data = [],
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getDataConfigClock()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $title = $this->_scopeConfig->getValue("clock/default_clock/title_clock", $storeScope);
        $size = $this->_scopeConfig->getValue("clock/default_clock/size_clock", $storeScope);
        $colorClock= $this->_scopeConfig->getValue("clock/default_clock/color_clock", $storeScope);
        $textColor = $this->_scopeConfig->getValue("clock/default_clock/text_color", $storeScope);

        $array = [
            'title' => $title,
            'size' => $size,
            'colorClock' => $colorClock,
            'textColor' => $textColor
        ];
        return $array;
    }

}