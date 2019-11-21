<?php
namespace Magenest\Chapter1\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface {

    protected $ruleCollectionFactory;
    protected $jsonHelper;
    public function __construct(
       \Magenest\Chapter1\Model\ResourceModel\Rule\CollectionFactory $ruleCollectionFactory,
       \Magento\Framework\Json\Helper\Data $jsonHelper
    ) {
        $this->ruleCollectionFactory = $ruleCollectionFactory;
        $this->jsonHelper = $jsonHelper;
    }
    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $setup->startSetup();

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $productMetadata = $objectManager->get('Magento\Framework\App\ProductMetadataInterface');
            $version = $productMetadata->getVersion();
            $version = substr($version,0,3);
            if ($version < 2.2)
            {
                $ruleCollection = $this->ruleCollectionFactory->create();
                foreach ($ruleCollection as $rule)
                {
                    $ruleSerialize = $rule->getData('conditions_serialized');
                    $ruleDecodeJson = $this->jsonHelper->jsonDecode($ruleSerialize);
                    $rule->setData('conditions_serialized',serialize($ruleDecodeJson));
                    $rule->save();
                }
            }
            else
            {
                $ruleCollection = $this->ruleCollectionFactory->create();
                foreach ($ruleCollection as $rule)
                {
                    $ruleSerialize = $rule->getData('conditions_serialized');
                    $ruleUnSerialize = unserialize($ruleSerialize);
                    $rule->setData('conditions_serialized',$this->jsonHelper->jsonEncode($ruleUnSerialize));
                    $rule->save();
                }
            }

            $setup->endSetup();
        }

    }
}