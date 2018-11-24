<?php

class Florczak_ImageUploader_Model_Observer
{

    protected $_product;

    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function additionalImageLoad(Varien_Event_Observer $observer)
    {
        $this->_product = $observer->getEvent()->getProduct();
        /* @var $product Mage_Catalog_Model_Product */
        $this->_product->setAdditionalImages($this->_getAdditionalImageIds());
        return $this;
    }

    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function saveAdditionalImages(Varien_Event_Observer $observer)
    {
        $controller = $observer->getEvent()->getControllerAction();
        /* @var $controller Mage_Adminhtml_Catalog_ProductController */
        $productParams = $controller->getRequest()->getParam('product');
        if (isset($productParams['additional_images'])) {
            $productId = $controller->getRequest()->getParam('id');
            $updateService = Mage::getModel('imageuploader/services_product_image_update');
            /* @var $updateService Florczak_ImageUploader_Model_Services_Product_Image_Update */
            $updateService->update($productId, $productParams['additional_images']);
        }
        return $this;
    }

    /**
     * @return array
     */
    protected function _getAdditionalImageIds()
    {
        $productImages = $this->_getProductImages();
        $ids = [];
        foreach ($productImages as $productImage) {
            $ids[] = $productImage->getImageId();
        }
        return $ids;
    }

    /**
     * @return Florczak_ImageUploader_Model_Resource_Image_Collection
     */
    protected function _getProductImages()
    {
        return Mage::getModel('imageuploader/product_image')
            ->getCollection()
            ->addFieldToFilter('product_id', $this->_product->getId());
    }

}
