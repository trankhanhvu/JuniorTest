<?php

namespace Magenest\Chapter1\Model\ResourceModel;

/**
 * Class Gallery
 * @package Magenest\ImageGallery\Model\ResourceModel
 */
class Rule extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_eventPrefix     = 'catalog_category';
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magenest_rules', 'id');
    }
}
