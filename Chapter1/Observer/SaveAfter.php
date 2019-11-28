<?php
namespace Magenest\Chapter1\Observer;
use Magento\Framework\Event\ObserverInterface;
class SaveAfter implements ObserverInterface
{
    protected $date;

    protected $timeFactory;

    protected $ruleRepository;

    protected $ruleDataFactory;

    public function __construct(\Magento\Framework\Stdlib\DateTime\DateTime $date,
                                \Magenest\Chapter1\Model\TimeFactory $timeFactory,
                                \Magenest\Chapter1\Api\RuleRepositoryInterface $ruleRepository,
                                \Magenest\Chapter1\Model\Data\RuleFactory $ruleDataFactory)
    {
        $this->date = $date;
        $this->timeFactory = $timeFactory;
        $this->ruleRepository = $ruleRepository;
        $this->ruleDataFactory = $ruleDataFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $time = $this->date->gmtDate();
        $timeModel = $this->timeFactory->create();
        $timeModel->setData('load_after',null);
        $timeModel->setData('model_save_after',$time);
        $timeModel->save();

        $id = 0;
        foreach ($observer->getData() as $rule)
        {
            $id = $rule->getData('id');
        }
        $rule = $this->ruleRepository->getById($id);
        $rule->setTitle('hahaha');

    }
}