<?php
namespace Magenest\ChapterFive\Ui\DataProvider\Product;
class AddMagenestVarCharFieldToCollection implements \Magento\Ui\DataProvider\AddFieldToCollectionInterface
{
    public function addField(\Magento\Framework\Data\Collection $collection, $field, $alias = null)
    {
        $collection->joinField('magenest_varchar', 'catalog_product_entity_varchar', 'magenest_varchar', 'entity_id=entity_id', null, 'left');
    }
}