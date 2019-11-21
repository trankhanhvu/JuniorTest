<?php
namespace Magenest\Chapter1\Controller\Chapter1;
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;
    protected $ruleFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Chapter1\Model\RuleFactory $ruleFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->ruleFactory = $ruleFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $ruleModel = $this->ruleFactory->create()->load(1);
        $ruleModel->setData('title','hello');
        $ruleModel->save();
        return $resultPage;
    }
}