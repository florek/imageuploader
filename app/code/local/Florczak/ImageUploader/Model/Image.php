<?php

class Florczak_ImageUploader_Model_Image extends Mage_Core_Model_Abstract
{

    const PENDING_ID = 0;
    const REJECTED_ID = 1;
    const ACCEPTED_ID = 2;

    const PENDING_LABEL = 'Pending';
    const ACCEPTED_LABEL = 'Accepted';
    const REJECTED_LABEL = 'Rejected';

    protected function _construct()
    {
        $this->_init('imageuploader/image');
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    protected function _afterSave()
    {
        $fileName = $this->getOrigData('file_name');
        if ($fileName !== $this->getFileName()) {
            try {
                $pathService = Mage::getModel('imageuploader/services_image_path');
                /* @var $pathService Florczak_ImageUploader_Model_Services_Image_Path */
                @unlink($pathService->getImagePath() . DS . $fileName);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        return parent::_afterSave();
    }

    /**
     * @return Mage_Core_Model_Abstract
     */
    protected function _afterDelete()
    {
        try {
            $pathService = Mage::getModel('imageuploader/services_image_path');
            /* @var $pathService Florczak_ImageUploader_Model_Services_Image_Path */
            @unlink($pathService->getImagePath() . DS . $this->getFileName());
        } catch (Exception $e) {
            Mage::logException($e);
        }
        return parent::_afterDelete();
    }

}
