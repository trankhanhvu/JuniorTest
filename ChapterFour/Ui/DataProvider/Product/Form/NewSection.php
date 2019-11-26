<?php

namespace Magenest\ChapterFour\Ui\DataProvider\Product\Form;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\View\Element\Text;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Fieldset;

class NewSection extends AbstractModifier
{
    /**
     * @param array $meta
     *
     * @return array
     */
    public function modifyMeta(array $meta): array
    {
        $meta['magenest_new_section'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Magenest New Section'),
                        'sortOrder' => 1,
                        'collapsible' => true,
                        'componentType' => Fieldset::NAME
                    ]
                ]
            ],
            'children' => [
                'magenest_select_field' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'select',
                                'componentType' => Field::NAME,
                                'options' => [
                                    ['value' => 'test_value_1', 'label' => 'Test Value 1'],
                                    ['value' => 'test_value_2', 'label' => 'Test Value 2'],
                                    ['value' => 'test_value_3', 'label' => 'Test Value 3'],
                                ],
                                'visible' => 1,
                                'required' => 1,
                                'label' => __('Select field')
                            ]
                        ]
                    ]
                ],
                'magenest_text_field' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                                'componentType' => Field::NAME,
                                'visible' => 1,
                                'required' => 1,
                                'label' => __('Text field')
                            ]
                        ]
                    ]
                ],
            ]
        ];

        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}