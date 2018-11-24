<?php

/* @var $this Mage_Core_Model_Resource_Setup */

$installer = $this;
$installer->startSetup();
$imageTable = $installer->getConnection()->newTable('florczak_imageuploader_image')
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'primary' => true,
            'nullable' => false,
            'unsigned' => true
        ],
        'ID'
    )
    ->addColumn(
        'file_name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        255,
        [
            'nullable' => false
        ],
        'File Name'
    )
    ->addColumn(
        'status',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        null,
        [
            'nullable' => false
        ],
        'Status'
    );
$imageProductImage = $installer->getConnection()->newTable('florczak_imageuploader_product_image')
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'primary' => true,
            'nullable' => false,
            'unsigned' => true
        ],
        'ID'
    )
    ->addColumn(
        'product_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Product ID'
    )
    ->addColumn(
        'image_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Image ID'
    )
    ->addForeignKey(
        $this->getFkName(
            $this->getTable('imageuploader_product_image'),
            'product_id',
            $this->getTable('catalog_product_entity'),
            'entity_id'
        ),
        'product_id',
        $this->getTable('catalog_product_entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $this->getFkName(
            $this->getTable('imageuploader_product_image'),
            'image_id',
            $this->getTable('imageuploader_image'),
            'id'
        ),
        'image_id',
        $this->getTable('imageuploader_image'),
        'id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );
$installer->getConnection()->createTable($imageTable);
$installer->getConnection()->createTable($imageProductImage);
$installer->endSetup();
