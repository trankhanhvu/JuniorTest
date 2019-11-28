<?php

namespace Magenest\Chapter1\Model\ResourceModel;

use Magenest\Chapter1\Model\RuleRegistry;
use Magenest\Chapter1\Model\RuleFactory;
use Magenest\Chapter1\Api\Data\RuleInterface;
use Magenest\Chapter1\Api\Data\RuleInterfaceFactory;
use Magenest\Chapter1\Api\Data\RuleSearchResultInterfaceFactory;
use Magenest\Chapter1\Model\Rule;
use Magenest\Chapter1\Model\ResourceModel\Rule as RuleResource;
use Magenest\Chapter1\Model\ResourceModel\Rule\Collection;
use Magenest\Chapter1\Api\RuleRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

class RuleRepository implements RuleRepositoryInterface
{

    private $ruleRegistry;

    private $ruleFactory;

    private $ruleResourceModel;

    private $dataObjectProcessor;

    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    private $ruleDataFactory;

    public function __construct(
        RuleRegistry $ruleRegistry,
        RuleFactory $ruleFactory,
        RuleResource $ruleResourceModel,
//        DataObjectProcessor $dataObjectProcessor,
//        JoinProcessorInterface $extensionAttributesJoinProcessor,
        RuleSearchResultInterfaceFactory $searchResultsFactory,
        RuleInterfaceFactory $ruleDataFactory
    )
    {
        $this->ruleRegistry = $ruleRegistry;
        $this->ruleFactory = $ruleFactory;
        $this->ruleResourceModel = $ruleResourceModel;
//        $this->dataObjectProcessor = $dataObjectProcessor;
//        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->ruleDataFactory = $ruleDataFactory;
    }


    public function save(RuleInterface $rule)
    {
        $ruleModel = $this->ruleFactory->create();
        if ($rule->getId()) {
            $this->ruleResourceModel->load($ruleModel,$rule->getId());
        }
        $ruleModel->setData('rule-type',$rule->getRuleType())
            ->setData('status',$rule->getStatus())
            ->setData('title',$rule->getTitle())
            ->setData('conditions_serialized',$rule->getConditionSerialized());
        try {
            $this->ruleResourceModel->save($ruleModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $ruleModel->getData();
    }


    public function getById($id)
    {
        $ruleModel = $this->ruleRegistry->retrieve($id);
        $ruleDataObject = $this->ruleDataFactory->create()
            ->setId($ruleModel->getData('id'))
            ->setTitle($ruleModel->getData('title'))
            ->setStatus($ruleModel->getData('status'))
            ->setRuleType($ruleModel->getData('rule-type'))
            ->setConditionSerialized($ruleModel->getData('conditions_serialized'));
        return $ruleDataObject;
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->ruleFactory->create()->getCollection();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(),
                    [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());

        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder($sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }

        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $rules = [];

        foreach ($collection as $rule) {
            $ruleDataObject = $this->ruleDataFactory->create()
                ->setId($rule->getData('id'))
                ->setTitle($rule->getData('title'))
                ->setStatus($rule->getData('status'))
                ->setRuleType($rule->getData('rule-type'))
                ->setConditionSerialized($rule->getData('conditions_serialized'));
            $rules[] = $ruleDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($rules);
    }

    public function delete(RuleInterface $rule)
    {
        return $this->deleteById($rule->getId());
    }

    public function deleteById($id)
    {
        $ruleModel = $this->ruleRegistry->retrieve($id);
        if ($id <= 0) {
            throw new
            StateException(__('Cannot delete rule item.'));
        }
        $this->ruleResourceModel->delete($ruleModel);
        $this->ruleRegistry->remove($id);
        return true;
    }
}
