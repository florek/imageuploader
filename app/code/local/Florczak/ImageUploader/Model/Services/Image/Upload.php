<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Image_Upload
 *
 * This class is used as a service to avoid duplicated code
 */
class Florczak_ImageUploader_Model_Services_Image_Upload
{

    /**
     * This method returns a file name of an uploaded file based on files from a fiven form
     *
     * @param array $filesPost
     * @return null|string
     */
    public function getUploadedImageFileName($filesPost = [])
    {
        $uploader = $this->_getUploader($filesPost);
        /* @var $uploader Varien_File_Uploader */
        if ($uploader) {
            return $uploader->getUploadedFileName();
        }
        return null;
    }

    /**
     * This method creates and returns the varien file uploader
     *
     * @param array $filesPost
     * @return null|Varien_File_Uploader
     */
    protected function _getUploader($filesPost = [])
    {
        $pathService = Mage::getModel('imageuploader/services_image_path');
        /* @var $pathService Florczak_ImageUploader_Model_Services_Image_Path */
        $path = $pathService->getImagePath();
        if (true === isset($filesPost['image']['name']) && false === empty($filesPost['image']['name'])) {
            $uploader = new Varien_File_Uploader('image');
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $uploader->save($path, time() . $filesPost['image']['name']);
            return $uploader;
        }
        return null;
    }

}
