<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Image_Url
 *
 * This class is used as a service to avoid duplicated code
 */
class Florczak_ImageUploader_Model_Services_Image_Url
{

    /**
     * This method returns an image url (path) - without a file name for uploaded images
     *
     * @return string
     */
    public function getImageUrl()
    {
        return Mage::getBaseUrl('media') . '/' . 'product_images';
    }

}
