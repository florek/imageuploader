<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Image_Path
 *
 * This class is used as a service to avoid duplicated code
 */
class Florczak_ImageUploader_Model_Services_Image_Path
{

    /**
     * This method returns a path to additinal product images
     *
     * @return string
     */
    public function getImagePath()
    {
        return Mage::getBaseDir('media') . DS . 'product_images';
    }

}
