<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Grid_Column_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    protected $_row;

    protected  function _construct()
    {
        parent::_construct();
        $this->setTemplate('imageuploader/images/grid/column/image.phtml');
    }

    /**
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        $this->_row = $row;
        return $this->_toHtml();
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        $image = $this->_row;
        /* @var $image Florczak_ImageUploader_Model_Image */
        $urlService = Mage::getModel('imageuploader/services_image_url');
        /* @var $urlService Florczak_ImageUploader_Model_Services_Image_Url */
        return $urlService->getImageUrl() . '/' . $image->getFileName();
    }

}
