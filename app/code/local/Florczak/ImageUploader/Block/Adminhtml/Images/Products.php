<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Products extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_images_products';
        $this->_blockGroup = 'imageuploader';
        $this->_headerText = $this->__('Products');
        parent::__construct();
        $this->_removeButton('add');
    }
}
