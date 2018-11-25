<?php

abstract class Florczak_ImageUploader_Block_Catalog_Product_View_Abstract
    extends Mage_Core_Block_Template
{

    protected function _toHtml()
    {
        if (Mage::getStoreConfig('imageuploader_settings/basic_settings/active')) {
            return parent::_toHtml();
        }
    }

}
