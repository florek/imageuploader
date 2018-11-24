<?php

require_once Mage::getBaseDir() . DS . 'app' . DS . 'code' . DS . 'local' . DS . 'Florczak' . DS . 'ImageUploader' . DS
    . 'controllers' . DS . 'Adminhtml' . DS . 'AbstractController.php';

class Florczak_ImageUploader_Adminhtml_ImagesController extends Florczak_ImageUploader_Adminhtml_AbstractController
{

    public function acceptImageAction()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $image = Mage::getModel('imageuploader/image')->load($id);
            if ($image->getId()) {
                $image->setStatus(Florczak_ImageUploader_Model_Image::ACCEPTED_ID);
                $image->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Successfully activated.'));
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Element doesn\'t exist.'));
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError('An error occured during save.');
            Mage::logException($e);
        }
        $this->_redirect('*/*');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $image = Mage::getModel('imageuploader/image')->load($id);
            if ($image->getId()) {
                $image->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Successfully deleted.'));
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Element doesn\'t exist.'));
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError('An error occured during save.');
            Mage::logException($e);
        }
        $this->_redirect('*/*');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $image = Mage::getModel('imageuploader/image')->load($id);
        /* @var $image Florczak_ImageUploader_Model_Image */
        Mage::register('image_data', $image);
        $this->loadLayout();
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('imageuploader/adminhtml_images_grid')->toHtml()
        );
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $image = Mage::getModel('imageuploader/image');
        /* @var $image Florczak_ImageUploader_Model_Image */
        Mage::register('image_data', $image);
        $this->loadLayout();
        $this->renderLayout();
    }

    public function rejectImageAction()
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $image = Mage::getModel('imageuploader/image')->load($id);
            if ($image->getId()) {
                $image->setStatus(Florczak_ImageUploader_Model_Image::REJECTED_ID);
                $image->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Successfully rejected.'));
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Element doesn\'t exist.'));
            }
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError('An error occured during save.');
            Mage::logException($e);
        }
        $this->_redirect('*/*');
    }

    public function saveAction()
    {
        $id = $this->getRequest()->getParam('id');
        $postData = $this->getRequest()->getPost();
        try {
            $imageSaveService = Mage::getModel('imageuploader/services_image_save');
            /* @var $imageSaveService Florczak_ImageUploader_Model_Services_Image_Save */
            $imageSaveService->save($id, $postData);
            Mage::getSingleton('adminhtml/session')->addSuccess('Successfully saved!');
            $this->_redirect('*/*');
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError('An error occured during save.');
        }
    }

}
