<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $image = Mage::registry('image_data');
        /* @var $image Florczak_ImageUploader_Model_Image */
        $form = new Varien_Data_Form(
            [
                'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
                'enctype' => 'multipart/form-data',
                'id' => 'edit_form',
                'method' => 'post'
            ]
        );
        $form->setUseContainer(true);
        $fieldset = $form->addFieldset('base_fieldset', [
            'class' => 'fieldset-wide',
            'legend' => $this->__('General')
        ]);
        $fieldset->addField('image', 'file', [
            'label' => $this->__('Product Image'),
            'name' => 'image',
            'after_element_html' => $this->getLayout()->createBlock('imageuploader/adminhtml_images_edit_form_fields_image')->toHtml()
        ]);
        $statusService = Mage::getModel('imageuploader/services_image_status');
        /* @var $statusService Florczak_ImageUploader_Model_Services_Image_Status */
        $fieldset->addField('status', 'select', [
            'label' => $this->__('Status'),
            'name' => 'status',
            'values' => $statusService->getStatuses(),
            'required' => true
        ]);
        $form->setValues($image->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
