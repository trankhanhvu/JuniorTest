<?php
namespace Magenest\ChapterTwo\Model\Config\Source;
class SizeClock implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {

        $option = [
            ['label' => 'Small', 'value' => '0'],
            ['label' => 'Medium', 'value' => '1'],
            ['label' => 'Large', 'value' => '2']
        ];

        return $option;
    }
}