<?php
require_once Mage::getBaseDir() . DS . 'app' . DS . 'code' . DS . 'local' . DS . 'Florczak' . DS . 'ImageUploader' . DS
    . 'controllers' . DS . 'Adminhtml' . DS . 'AbstractController.php';

class Florczak_ImageUploader_Adminhtml_Images_ProductController extends Florczak_ImageUploader_Adminhtml_AbstractController
{
    public function gridAction()
    {
        $id = $this->getRequest()->getParam('id');
        $image = Mage::getModel('imageuploader/image')->load($id);
        /* @var $image Florczak_ImageUploader_Model_Image */
        Mage::register('image_data', $image);
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('imageuploader/adminhtml_images_products_grid')->toHtml()
        );
    }

}
