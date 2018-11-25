<?php

$installer = $this;
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$attribute = [
    'group' => 'General',
    'source' => 'imageuploader/catalog_product_attribute_additional_image_source',
    'sort_order' => 7,
    'label' => 'Additional Images',
    'input' => 'multiselect',
    'backend' => '',
    'frontend' => '',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => false,
    'searchable' => true,
    'filterable' => true,
    'comparable' => true,
    'visible_on_front' => true,
    'visible_in_advanced_search' => true,
    'unique' => false,
];

$setup->addAttribute(Mage_Catalog_Model_Product::ENTITY, 'additional_images', $attribute);
$installer->endSetup();
