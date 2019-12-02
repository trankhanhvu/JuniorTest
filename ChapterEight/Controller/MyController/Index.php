<?php
namespace Magenest\ChapterEight\Controller\MyController;
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $myInterface;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\ChapterEight\Api\MyInterface $myInterface
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->myInterface = $myInterface;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $this->myInterface->foo();
        return $resultPage;
    }
}