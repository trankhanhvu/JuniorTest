<?php
namespace Magenest\Chapter1\Model\ResourceModel\Time;

/**
 * Image Collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Initialize resource collection
     * *
    @return void
     */
    public function _construct()
    {
        $this->_init('Magenest\Chapter1\Model\Time', 'Magenest\Chapter1\Model\ResourceModel\Time');
    }

}
