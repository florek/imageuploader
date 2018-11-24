<?php

class Florczak_ImageUploader_Model_Resource_Product_Image extends Mage_Core_Model_Mysql4_Abstract
{

    protected function _construct()
    {
        $this->_init('imageuploader/product_image', 'id');
    }

}
