<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Edit_Form_Fields_Image extends Mage_Adminhtml_Block_Template
{

    public function __construct()
    {
        $image = Mage::registry('image_data');
        /* @var $image Florczak_ImageUploader_Model_Image */
        if ($image->getId()) {
            $this->setTemplate('imageuploader/images/edit/form/fields/image.phtml');
        }
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        $image = Mage::registry('image_data');
        /* @var $image Florczak_ImageUploader_Model_Image */
        $urlService = Mage::getModel('imageuploader/services_image_url');
        /* @var $urlService Florczak_ImageUploader_Model_Services_Image_Url */
        return $urlService->getImageUrl() . '/' . $image->getFileName();
    }

}
