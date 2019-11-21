<?php

namespace Magenest\Chapter1\Setup;

/**
 * Class InstallSchema
 * @package Magenest\ImageGallery\Setup
 */
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     */
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        // create image table
        $tableImage = $installer->getConnection()
            ->newTable($installer->getTable('magenest_rules'))
            ->addColumn(
                'id',
                \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true]
            )->addColumn(
                'title',
                \Magento\Framework\Db\Ddl\Table::TYPE_TEXT,
                50,
                ['nullable' => false]
            )->addColumn(
                'status',
                \Magento\Framework\Db\Ddl\Table::TYPE_TEXT,
                10,
                ['nullable' => false]
            )->addColumn(
                'rule-type',
                \Magento\Framework\Db\Ddl\Table::TYPE_INTEGER,
                11,
                ['nullable' => false]
            )->addColumn(
                'conditions_serialized',
                \Magento\Framework\Db\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false]
            );
        $installer->getConnection()->createTable($tableImage);
    }
}
