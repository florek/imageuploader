<?php

class Florczak_ImageUploader_Model_Services_Image_Url
{

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return Mage::getBaseUrl('media') . '/' . 'product_images';
    }

}
