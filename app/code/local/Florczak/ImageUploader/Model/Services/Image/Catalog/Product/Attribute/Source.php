<?php

class Florczak_ImageUploader_Model_Services_Image_Catalog_Product_Attribute_Source
    extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * @return array
     */
    public function getAllOptions()
    {
        $images = Mage::getModel('imageuploader/image')
            ->getCollection();
        /* @var $images Florczak_ImageUploader_Model_Resource_Image_Collection */
        $options = [];
        foreach ($images as $image) {
            $options[] = [
                'label' => $image->getFileName(),
                'value' => $image->getId()
            ];
        }
        return $options;
    }

}
