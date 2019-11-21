<?php

namespace Magenest\Chapter1\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0) {
            $tableImage = $installer->getConnection()
                ->newTable($installer->getTable('magenest_time_load_save'))
                ->addColumn(
                    'id',
                    \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
                )->addColumn(
                    'load_after',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Load after'
                )->addColumn(
                    'model_save_after',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => true],
                    'Save After'
                );
            $installer->getConnection()->createTable($tableImage);
        }
        $installer->endSetup();
    }
}