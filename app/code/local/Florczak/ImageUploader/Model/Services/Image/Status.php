<?php

class Florczak_ImageUploader_Model_Services_Image_Status
{

    /**
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
