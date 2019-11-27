<?php
namespace Magenest\ChapterFive\Ui\Component\Listing\Column;
class SelectCustomer extends \Magento\Ui\Component\Listing\Columns\Column {

    protected $productRepository;
    protected $groupRepository;
    protected $authSession;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $components = [],
        array $data = []
    ){
        $this->productRepository = $productRepository;
        $this->groupRepository = $groupRepository;
        $this->authSession = $authSession;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $product = $this->productRepository->getById($item['entity_id']);
                $magenestSelectCustomer = $product->getData('magenest_select_customer');
                if ($magenestSelectCustomer != null)
                {
                    $group = $this->groupRepository->getById($magenestSelectCustomer);
                    $magenestSelectCustomer = $group->getCode();
                }

                $magenestVarchar = $product->getData('magenest_varchar');
                $item['magenest_select_customer'] = $magenestSelectCustomer;
                $item['magenest_varchar'] = $magenestVarchar;
            }
        }
        return $dataSource;
    }

    public function prepare()
    {
        parent::prepare();
        $admin = $this->authSession->getUser();
        $firstname = $admin->getFirstName();
        $firstCharacter = substr($firstname,0,1);
        $checkFromAtoM = preg_match('/[a-mA-M]/', $firstCharacter);
        if ($checkFromAtoM != 1)
            $this->_data['config']['componentDisabled'] = true;
    }
}