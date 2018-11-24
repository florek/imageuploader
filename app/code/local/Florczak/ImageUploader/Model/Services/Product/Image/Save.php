<?php

class Florczak_ImageUploader_Model_Services_Product_Image_Save
{

    public function save($productId, $imageId)
    {
        try {
            $image = Mage::getModel('imageuploader/product_image');
            /* @var $image Florczak_ImageUploader_Model_Product_Image */
            $image->setImageId($imageId);
            $image->setProductId($productId);
            $image->save();
        } catch (Exception $e) {
            Mage::logException($e);
            throw $e;
        }
    }

}
