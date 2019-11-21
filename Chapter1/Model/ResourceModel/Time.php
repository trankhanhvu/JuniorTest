<?php

namespace Magenest\Chapter1\Model\ResourceModel;

/**
 * Class Gallery
 * @package Magenest\ImageGallery\Model\ResourceModel
 */
class Time extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magenest_time_load_save', 'id');
    }
}
