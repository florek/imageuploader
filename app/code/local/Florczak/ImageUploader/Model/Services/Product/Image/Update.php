<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Product_Image_Update
 *
 * This class is used as a service to avoid duplicated cod
 */
class Florczak_ImageUploader_Model_Services_Product_Image_Update
{

    /**
     * This method is used for proper update from the edit page
     *
     * @param int $productId
     * @param array $additionalImageIds
     */
    public function update($productId, array $additionalImageIds)
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
        /* @var $connection Magento_Db_Adapter_Pdo_Mysql */
        try {
            $connection->beginTransaction();
            $this->_removeOldEntities($productId);
            $this->_createNewEntities($productId, $additionalImageIds);
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
            Mage::logException($e);
        }
    }

    /**
     * This method creates new entities of the product image model
     *
     * @param int $productId
     * @param array $additionalImageIds
     */
    protected function _createNewEntities($productId, $additionalImageIds)
    {
        foreach ($additionalImageIds as $additionalImageId) {
            $productImage = Mage::getModel('imageuploader/product_image');
            /* @var $productImage Florczak_ImageUploader_Model_Product_Image */
            $productImage->setProductId($productId);
            $productImage->setImageId($additionalImageId);
            $productImage->save();
        }
    }

    /**
     * This method removes old entities of the product image model
     *
     * @param int $productId
     */
    protected function _removeOldEntities($productId)
    {
        $oldProductImages = Mage::getModel('imageuploader/product_image')
            ->getCollection()
            ->addFieldToFilter('product_id', $productId);
        /* @var $oldProductImages Florczak_ImageUploader_Model_Resource_Product_Image_Collection */
        foreach ($oldProductImages as $oldProductImage) {
            /* @var $oldProductImage Florczak_ImageUploader_Model_Product_Image */
            $oldProductImage->delete();
        }
    }

}
