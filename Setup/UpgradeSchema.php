<?php


namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.3.9') < 0) {
            $installer = $setup;
            $installer->startSetup();
            $connection = $installer->getConnection();

            // create table magenest_director
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_director')
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'Director Id'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'name'
            );
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('magenest_director'),
                $setup->getIdxName(
                    $installer->getTable('magenest_director'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );



            //Install magenest_movie
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'Movie Id'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'name'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'description'
            )->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'unsigned' => true,
                    'nullable' => false
                ]
            )->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'unsigned' => true,
                ]
            );
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('magenest_movie'),
                $setup->getIdxName(
                    $installer->getTable('magenest_movie'),
                    ['name', 'description'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'description'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );


            // create table magenest_actor
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_actor')
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'actor Id'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [
                    'nullable' => false
                ],
                'name'
            );
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex(
                $installer->getTable('magenest_actor'),
                $setup->getIdxName(
                    $installer->getTable('magenest_actor'),
                    ['name'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );



            // create table magenest_movie_actor
            $table = $installer->getConnection()->newTable(
                $installer->getTable('magenest_movie_actor')
            )->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'movie id'
            )->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [
                    'identity' => false,
                    'nullable' => false,
                    'primary' => true,
                    'unsigned' => true,
                ],
                'actor id'
            );
            $installer->getConnection()->createTable($table);







            $installer->getConnection()->addForeignKey(
                $installer->getFkName('magenest_movie', 'director_id', 'magenest_director', 'director_id'),
                'magenest_movie',
                'director_id',
                'magenest_director',
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
            $installer->getConnection()->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                'magenest_movie_actor',
                'movie_id',
                'magenest_movie',
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
            $installer->getConnection()->addForeignKey(
                $installer->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                'magenest_movie_actor',
                'actor_id',
                'magenest_actor',
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );
            $installer->endSetup();
        }
    }
}