<?php
namespace Magenest\Chapter1\Controller\Chapter1;
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;
    protected $ruleFactory;
    protected $productFactory;
    protected $ruleRepository;
    protected $ruleDataFactory;
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Chapter1\Model\RuleFactory $ruleFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magenest\Chapter1\Api\RuleRepositoryInterface $ruleRepository,
        \Magenest\Chapter1\Model\Data\RuleFactory $ruleDataFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->ruleFactory = $ruleFactory;
        $this->productFactory = $productFactory;
        $this->ruleRepository = $ruleRepository;
        $this->ruleDataFactory = $ruleDataFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $ruleModel = $this->ruleFactory->create()->load(3);
        $ruleModel->setData('title','hello');
        $ruleModel->save();

//        $productModel = $this->productFactory->create()->load(3);
//        $productModel->setData('magenest_varchar','testne');
//        $productModel->setName('Test Product');
//        $productModel->setTypeId('simple');
//        $productModel->setAttributeSetId(4);
//        $productModel->setSku('test-SKU');
//        $productModel->setWebsiteIds(array(1));
//        $productModel->setVisibility(4);
//        $productModel->setPrice(array(1));
//        $productModel->save();


//        $ruleData = $this->ruleDataFactory->create();
//        $ruleData->setId(4);
//        $ruleData->setData('title','he');
//        $rule = $this->ruleRepository->save($ruleData);
//        $rule = $this->ruleRepository->delete($ruleData);

//        $searchCriteria = $this->searchCriteriaBuilder->create();
//        $searchResult = $this->ruleRepository->getList($searchCriteria);
//        foreach ($searchResult->getItems() as $item) {
//            echo $item->getId() . ' => ' . $item->getTitle() . '<br>';
//        }
        return $resultPage;
    }
}