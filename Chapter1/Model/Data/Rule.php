<?php

namespace Magenest\Chapter1\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Magenest\Chapter1\Api\Data\RuleInterface;

class Rule extends AbstractExtensibleObject implements RuleInterface
{

    public function getId()
    {
        return $this->_get(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function getRuleType()
    {
        return $this->_get(self::RULE_TYPE);
    }

    public function setRuleType($rule_type)
    {
        return $this->setData(self::RULE_TYPE, $rule_type);
    }

    public function getConditionSerialized()
    {
        return $this->_get(self::CONDITION_SERIALIZED);
    }

    public function setConditionSerialized($condition_serialized)
    {
        return $this->setData(self::CONDITION_SERIALIZED, $condition_serialized);
    }
}
