<?php

namespace Magenest\Chapter1\Api;

interface RuleRepositoryInterface
{
    public function save(\Magenest\Chapter1\Api\Data\RuleInterface $rule);

    public function getById($rule_id);

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    public function delete(\Magenest\Chapter1\Api\Data\RuleInterface $rule);

    public function deleteById($rule_id);
}
