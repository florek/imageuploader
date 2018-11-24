<?php

class Florczak_ImageUploader_Block_Adminhtml_Images extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_images';
        $this->_blockGroup = 'imageuploader';
        $this->_headerText = $this->__('Image Uploader - Product Images');
        parent::__construct();
    }
}
