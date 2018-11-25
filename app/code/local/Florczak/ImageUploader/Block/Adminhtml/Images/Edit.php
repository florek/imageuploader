<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_images';
        $this->_blockGroup = 'imageuploader';
        $this->_addButton('save_and_continue', [
            'label' => $this->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save'
        ], -100);
        $this->_formScripts[] = "
             function saveAndContinueEdit(){
                editForm.submit($('edit_form').action + 'back/edit/');
             }
        ";
    }

    /**
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('image_data') && Mage::registry('image_data')->getId()) {
            return $this->__('Edit');
        }
        return $this->__('Add');
    }

}
