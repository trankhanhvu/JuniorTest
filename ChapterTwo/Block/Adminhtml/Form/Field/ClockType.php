<?php
namespace Magenest\ChapterTwo\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Ranges
 */
class ClockType extends AbstractFieldArray
{

    private $customerGrouprender;
    private $clockTyperender;

    protected function _prepareToRender()
    {
        $this->addColumn('customer_group', [
            'label' => __('Customer Group'),
            'renderer' => $this->getCustomerGroupColumn()
        ]);
        $this->addColumn('clock_type', [
            'label' => __('Clock Type'),
            'renderer' => $this->getClockTypeColumn()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Type');
    }


    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $customerGroup = $row->getCustomerGroup();
        if ($customerGroup !== null) {
            $options['option_' . $this->getCustomerGroupColumn()->calcOptionHash($customerGroup)] = 'selected="selected"';
        }

        $clockType = $row->getClockType();
        if ($clockType !== null) {
            $options['option_' . $this->getClockTypeColumn()->calcOptionHash($clockType)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    private function getCustomerGroupColumn()
    {
        if (!$this->customerGrouprender) {
            $this->customerGrouprender = $this->getLayout()->createBlock(
                CustomerGroupColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->customerGrouprender;
    }

    private function getClockTypeColumn()
    {
        if (!$this->clockTyperender) {
            $this->clockTyperender = $this->getLayout()->createBlock(
                ClockTypeColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->clockTyperender;
    }
}