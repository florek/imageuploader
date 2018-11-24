<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Products_Grid_Column_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    /**
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        if ($row->getImageId() == Mage::registry('image_data')->getId()) {
            return $this->__('Assigned');
        }
        return $this->__('Not Assigned');
    }

}
