<?php

require_once Mage::getBaseDir() . DS . 'app' . DS . 'code' . DS . 'local' . DS . 'Florczak' . DS . 'ImageUploader' . DS
    . 'controllers' . DS . 'Adminhtml' . DS . 'AbstractController.php';


class Florczak_ImageUploader_Adminhtml_Images_Product_MassController extends Florczak_ImageUploader_Adminhtml_AbstractController
{

    public function massAssignAction()
    {
        $ids = $this->getRequest()->getParam('image_product_massaction');
        $imageId = $this->getRequest()->getParam('image_id');
        try {
            foreach ($ids as $id) {
                $imageProduct = Mage::getModel('imageuploader/product_image');
                /* @var $imageProduct Florczak_ImageUploader_Model_Product_Image */
                $imageProduct->setProductId($id);
                $imageProduct->setImageId($imageId);
                $imageProduct->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Successfully assigned.'));
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured during removal.'));
        }
        $this->_redirect('imageuploader/adminhtml_images/edit', ['id' => $imageId]);
    }

    public function massUnassignAction()
    {
        $ids = $this->getRequest()->getParam('image_product_massaction');
        $imageId = $this->getRequest()->getParam('image_id');
        try {
            $productsToUnassign = Mage::getModel('imageuploader/product_image')
                ->getCollection()
                ->addFieldToFilter('image_id', $imageId)
                ->addFieldToFilter('product_id', ['in' => $ids]);
            foreach ($productsToUnassign as $productToUnassign) {
                /* @var $productToUnassign Florczak_ImageUploader_Model_Product_Image */
                $productToUnassign->delete();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Successfully unassigned.'));
        } catch (Exception $e) {
            Mage::logException($e);
            die(var_dump($e->getMessage()));
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured during removal.'));
        }
        $this->_redirect('imageuploader/adminhtml_images/edit', ['id' => $imageId]);
    }

}
