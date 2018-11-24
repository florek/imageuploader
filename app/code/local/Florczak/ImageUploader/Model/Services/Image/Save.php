<?php

class Florczak_ImageUploader_Model_Services_Image_Save
{

    /**
     * @param int $id
     * @param array $postData
     * @return int|null
     * @throws Exception
     */
    public function save(&$id, array $postData)
    {
        try {
            $image = Mage::getModel('imageuploader/image')->load($id);
            /* @var $image Florczak_ImageUploader_Model_Image */
            $image->addData($postData);
            $uploadService = Mage::getModel('imageuploader/services_image_upload');
            /* @var $uploadService Florczak_ImageUploader_Model_Services_Image_Upload */
            $fileName = $uploadService->getUploadedImageFileName($_FILES);
            if ($fileName) {
                $image->setFileName($fileName);
            }
            $image->save();
            $id = $image->getId();
        } catch (Exception $e) {
            Mage::logException($e);
            throw $e;
        }
    }

}
