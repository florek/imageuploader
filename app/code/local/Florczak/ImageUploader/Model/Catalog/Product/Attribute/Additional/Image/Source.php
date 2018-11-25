<?php

/**
 * Class Florczak_ImageUploader_Model_Catalog_Product_Attribute_Additional_Image_Source
 *
 * This is an attribute source class
 */

class Florczak_ImageUploader_Model_Catalog_Product_Attribute_Additional_Image_Source
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * Get all images especially for a product edit page
     *
     * @return array
     */
    public function getAllOptions()
    {
        $images = Mage::getModel('imageuploader/image')
            ->getCollection()
            ->addFieldToFilter('status', Florczak_ImageUploader_Model_Image::ACCEPTED_ID);
        /* @var $images Florczak_ImageUploader_Model_Resource_Image_Collection */
        $options = [];
        foreach ($images as $image) {
            /* @var $image Florczak_ImageUploader_Model_Image */
            $options[] = [
                'label' => $image->getFileName(),
                'value' => $image->getId()
            ];
        }
        return $options;
    }

}
