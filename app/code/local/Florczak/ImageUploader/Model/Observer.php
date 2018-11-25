<?php

/**
 * Class Florczak_ImageUploader_Model_Observer
 *
 * This method is responsibility for modification of the load of product and modification of
 * postdispatch method of the product save action
 */
class Florczak_ImageUploader_Model_Observer
{

    /**
     * This method is used for set additional images field in the product model
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function additionalImageLoad(Varien_Event_Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        /* @var $product Mage_Catalog_Model_Product */;
        $product->setAdditionalImages($this->_getAdditionalImageIds($product));
        return $this;
    }

    /**
     * This method is used for save additional images field in the product model
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function saveAdditionalImages(Varien_Event_Observer $observer)
    {
        $controller = $observer->getEvent()->getControllerAction();
        /* @var $controller Mage_Adminhtml_Catalog_ProductController */
        $productParams = $controller->getRequest()->getParam('product');
        if (isset($productParams['additional_images'])) {
            if (!is_array($productParams['additional_images'])) {
                $productParams['additional_images'] = [];
            }
            $productId = $controller->getRequest()->getParam('id');
            $updateService = Mage::getModel('imageuploader/services_product_image_update');
            /* @var $updateService Florczak_ImageUploader_Model_Services_Product_Image_Update */
            $updateService->update($productId, $productParams['additional_images']);
        }
        return $this;
    }

    /**
     * @param Mage_Catalog_Model_Product $product
     * @return array
     */
    protected function _getAdditionalImageIds(Mage_Catalog_Model_Product $product)
    {
        $productImages = $this->_getProductImages($product->getId());
        $ids = [];
        foreach ($productImages as $productImage) {
            $ids[] = $productImage->getImageId();
        }
        return $ids;
    }

    /**
     * @param $productId
     * @return Florczak_ImageUploader_Model_Resource_Product_Image_Collection
     */
    protected function _getProductImages($productId)
    {
        return Mage::getModel('imageuploader/product_image')
            ->getCollection()
            ->addFieldToFilter('product_id', $productId);
    }

}
