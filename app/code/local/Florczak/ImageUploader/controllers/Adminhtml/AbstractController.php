<?php

abstract class Florczak_ImageUploader_Adminhtml_AbstractController extends Mage_Adminhtml_Controller_Action
{

    public function preDispatch()
    {
        $this->_title($this->__('ImageUploader - Product Images'));
        parent::preDispatch();
    }

    protected function _isAllowed()
    {
        if (!Mage::getStoreConfig('imageuploader_settings/basic_settings/active')) {
            return false;
        }
        return Mage::getSingleton('admin/session')->isAllowed('imageuploader/product_images');
    }

}
