<?php
namespace Magenest\ChapterFive\Ui\Component\Listing\Column;
class Varchar extends \Magento\Ui\Component\Listing\Columns\Column {

    protected $productRepository;
    protected $authSession;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Backend\Model\Auth\Session $authSession,
        array $components = [],
        array $data = []
    ){
        $this->productRepository = $productRepository;
        $this->authSession = $authSession;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource) {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $product = $this->productRepository->getById($item['entity_id']);
                $magenestVarchar = $product->getData('magenest_varchar');
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