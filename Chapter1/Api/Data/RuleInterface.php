<?php

namespace Magenest\Chapter1\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;


interface RuleInterface extends ExtensibleDataInterface
{
    const ID = 'id';

    const TITLE = 'title';

    const STATUS = 'status';

    const RULE_TYPE = 'rule-type';

    const CONDITION_SERIALIZED = 'conditions_serialized';

    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getStatus();

    public function setStatus($status);

    public function getRuleType();

    public function setRuleType($rule_type);

    public function getConditionSerialized();

    public function setConditionSerialized($condition_serialized);
}
