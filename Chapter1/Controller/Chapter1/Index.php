<?php
namespace Magenest\Chapter1\Controller\Chapter1;
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;
    protected $ruleFactory;
    protected $productFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Chapter1\Model\RuleFactory $ruleFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->ruleFactory = $ruleFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
//        $ruleModel = $this->ruleFactory->create()->load(1);
//        $ruleModel->setData('title','hello');
//        $ruleModel->save();

        $productModel = $this->productFactory->create()->load(3);
        $productModel->setData('magenest_varchar','testne');
        $productModel->setName('Test Product');
        $productModel->setTypeId('simple');
        $productModel->setAttributeSetId(4);
        $productModel->setSku('test-SKU');
        $productModel->setWebsiteIds(array(1));
        $productModel->setVisibility(4);
        $productModel->setPrice(array(1));
        $productModel->save();
        return $resultPage;
    }
}