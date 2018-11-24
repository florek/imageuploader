<?php
require_once Mage::getBaseDir() . DS . 'app' . DS . 'code' . DS . 'local' . DS . 'Florczak' . DS . 'ImageUploader' . DS
    . 'controllers' . DS . 'Adminhtml' . DS . 'AbstractController.php';

class Florczak_ImageUploader_Adminhtml_Images_MassController extends Florczak_ImageUploader_Adminhtml_AbstractController
{

    public function massDeleteAction()
    {
        $ids = $this->getRequest()->getParam('image_massaction');
        try {
            foreach ($ids as $id) {
                $image = Mage::getModel('imageuploader/image')->load($id);
                /* @var $image Florczak_ImageUploader_Model_Image */
                $image->delete();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured during removal.'));
        }
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Successfully deleted.'));
        $this->_redirect('imageuploader/adminhtml_images/index');
    }

    public function massAcceptAction()
    {
        $ids = $this->getRequest()->getParam('image_massaction');
        try {
            foreach ($ids as $id) {
                $image = Mage::getModel('imageuploader/image')->load($id);
                /* @var $image Florczak_ImageUploader_Model_Image */
                $image->setStatus(Florczak_ImageUploader_Model_Image::ACCEPTED_ID);
                $image->save();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured during saving.'));
        }
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Successfully accepted.'));
        $this->_redirect('imageuploader/adminhtml_images/index');
    }

    public function massRejectAction()
    {
        $ids = $this->getRequest()->getParam('image_massaction');
        try {
            foreach ($ids as $id) {
                $image = Mage::getModel('imageuploader/image')->load($id);
                /* @var $image Florczak_ImageUploader_Model_Image */
                $image->setStatus(Florczak_ImageUploader_Model_Image::REJECTED_ID);
                $image->save();
            }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occured during saving.'));
        }
        Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Successfully rejected.'));
        $this->_redirect('imageuploader/adminhtml_images/index');
    }

}
