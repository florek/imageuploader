<?php

class Florczak_ImageUploader_Block_Catalog_Product_View_Images
    extends Mage_Core_Block_Template
{

    /**
     * @return Florczak_ImageUploader_Model_Resource_Product_Image_Collection|object
     */
    public function getImages()
    {
        $images = Mage::getModel('imageuploader/product_image')
            ->getCollection();
        /* @var $images Florczak_ImageUploader_Model_Resource_Product_Image_Collection */
        $images->getSelect()->joinLeft(
            ['ii' => Mage::getSingleton('core/resource')->getTableName('florczak_imageuploader_image')],
            'ii.id=main_table.image_id'
        );
        $images->addFieldToFilter('ii.status', Florczak_ImageUploader_Model_Image::ACCEPTED_ID);
        $images->addFieldToFilter('product_id', Mage::registry('current_product')->getId());
        $images->getSelect()->group('ii.id');
        return $images;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function getImageUrl($fileName)
    {
        $urlImageService = Mage::getModel('imageuploader/services_image_url');
        /* @var $urlImageService Florczak_ImageUploader_Model_Services_Image_Url */
        return $urlImageService->getImageUrl() . '/' . $fileName;
    }

}
