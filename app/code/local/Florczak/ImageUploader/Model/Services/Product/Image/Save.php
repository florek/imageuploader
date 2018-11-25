<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Product_Image_Save
 *
 *
 * This class is used as a service to avoid duplicated code
 */
class Florczak_ImageUploader_Model_Services_Product_Image_Save
{

    /**
     * This method is responsibility for a proper saved of a relation between a product and an image
     *
     * @param int $productId
     * @param int $imageId
     * @throws Exception
     */
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
