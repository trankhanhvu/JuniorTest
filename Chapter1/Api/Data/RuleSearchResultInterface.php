<?php

namespace Magenest\Chapter1\Api\Data;

interface RuleSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    public function getItems();

    public function setItems(array $items);
}
