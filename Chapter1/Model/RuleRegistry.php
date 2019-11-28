<?php

namespace Magenest\Chapter1\Model;

use Magenest\Chapter1\Api\Data\RuleInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class RuleRegistry
{
    protected $registry = [];

    protected $ruleFactory;

    protected $ruleResource;

    public function __construct(RuleFactory $ruleFactory,
                                \Magenest\Chapter1\Model\ResourceModel\Rule $ruleResource)
    {
        $this->ruleFactory = $ruleFactory;
        $this->ruleResource = $ruleResource;
    }

    public function retrieve($id)
    {
        if (isset($this->registry[$id])) {
            return $this->registry[$id];
        }
        $rule = $this->ruleFactory->create();
        $this->ruleResource->load($rule,$id);
        if ($rule->getId() === null || $rule->getId() != $id) {
            throw NoSuchEntityException::singleField(RuleInterface::ID, $id);
        }
        $this->registry[$id] = $rule;
        return $rule;
    }

    public function remove($id)
    {
        unset($this->registry[$id]);
    }
}