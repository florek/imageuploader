<?php

class Florczak_ImageUploader_Model_Services_Image_Path
{

    /**
     * @return string
     */
    public function getImagePath()
    {
        return Mage::getBaseDir('media') . DS . 'product_images';
    }

}
