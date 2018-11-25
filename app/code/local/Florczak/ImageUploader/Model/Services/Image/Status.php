<?php

/**
 * Class Florczak_ImageUploader_Model_Services_Image_Status
 *
 * This class is used as a service to avoid duplicated code
 */
class Florczak_ImageUploader_Model_Services_Image_Status
{

    /**
     * This method returns statuses of an image as an array with options and labels
     *
     * @return array
     */
    public function getStatuses()
    {
        return [
            Florczak_ImageUploader_Model_Image::PENDING_ID => Florczak_ImageUploader_Model_Image::PENDING_LABEL,
            Florczak_ImageUploader_Model_Image::ACCEPTED_ID => Florczak_ImageUploader_Model_Image::ACCEPTED_LABEL,
            Florczak_ImageUploader_Model_Image::REJECTED_ID => Florczak_ImageUploader_Model_Image::REJECTED_LABEL
        ];
    }

}
