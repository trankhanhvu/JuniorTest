<?php
namespace Magenest\Chapter1\Observer;
use Magento\Framework\Event\ObserverInterface;
class SaveAfter implements ObserverInterface
{
    protected $date;

    protected $timeFactory;

    public function __construct(\Magento\Framework\Stdlib\DateTime\DateTime $date,
                                \Magenest\Chapter1\Model\TimeFactory $timeFactory)
    {
        $this->date = $date;
        $this->timeFactory = $timeFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $time = $this->date->gmtDate();
        $timeModel = $this->timeFactory->create();
        $timeModel->setData('load_after',null);
        $timeModel->setData('model_save_after',$time);
        $timeModel->save();
    }
}