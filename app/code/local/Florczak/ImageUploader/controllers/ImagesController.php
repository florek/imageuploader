<?php

class Florczak_ImageUploader_ImagesController extends Mage_Core_Controller_Front_Action
{

    public function uploadAction()
    {
        try {
            $productId = $this->getRequest()->getParam('product_id');
            $imageSaveService = Mage::getModel('imageuploader/services_image_save');
            /* @var $imageSaveService Florczak_ImageUploader_Model_Services_Image_Save */
            $id = null;
            $imageSaveService->save($id, $this->getRequest()->getPost());
            $productImageSaveService = Mage::getModel('imageuploader/services_product_image_save');
            /* @var $productImageSaveService Florczak_ImageUploader_Model_Services_Product_Image_Save */
            $productImageSaveService->save($productId, $id);
            Mage::getSingleton('core/session')->addSuccess($this->__('Your image is awaiting for acceptance.'));
        } catch (Exception $e) {
            Mage::getSingleton('core/session')->addError($this->__('An error occured during saving.'));
        }
        $this->_redirectReferer();
    }

}
