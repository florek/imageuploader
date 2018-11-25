<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Products_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('imageuploader_image_product_grid');
        $this->setSaveParametersInSession(true);
        $this->setFilterVisibility(true);
        $this->setPagerVisibility(true);
        $this->setUseAjax(true);
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('imageuploader/adminhtml_images_product/grid',
            [
                '_current' => true,
                'image_id' => Mage::registry('image_data')->getId()
            ]
        );
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name');
        /* @var $collection Florczak_ImageUploader_Model_Resource_Product_Image_Collection */
        $collection->getSelect()->joinLeft(
            ['ipi' => Mage::getSingleton('core/resource')->getTableName('florczak_imageuploader_product_image')],
            'e.entity_id=ipi.product_id AND ipi.image_id=' . Mage::registry('image_data')->getId()
        );
        $collection->getSelect()->order('ipi.product_id DESC');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', [
            'header' => $this->__('Id'),
            'index' => 'entity_id',
            'width' => '20px',
            'sortable' => false
        ]);
        $this->addColumn('sku', [
            'header' => $this->__('Sku'),
            'index' => 'sku',
            'width' => '20px',
            'sortable' => false
        ]);
        $this->addColumn('name', [
            'header' => $this->__('Name'),
            'index' => 'name',
            'width' => '120px',
            'sortable' => false
        ]);
        $this->addColumn('image_id', [
            'header' => $this->__('Status'),
            'index' => 'image_id',
            'filter' => false,
            'sortable' => false,
            'width' => '120px',
            'renderer' => 'imageuploader/adminhtml_images_products_grid_column_status'
        ]);
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('image_product_massaction');
        $this->getMassactionBlock()->addItem('delete', [
            'label' => $this->__('Assign'),
            'url' => $this->getUrl('imageuploader/adminhtml_images_product_mass/massAssign',
                ['image_id' => $this->getRequest()->getParam('id')]
            ),
            'confirm' => $this->__('Are you sure?')
        ]);
        $this->getMassactionBlock()->addItem('accept', [
            'label' => $this->__('Unassign'),
            'url' => $this->getUrl('imageuploader/adminhtml_images_product_mass/massUnassign',
                ['image_id' => $this->getRequest()->getParam('id')]
            ),
            'confirm' => $this->__('Are you sure?')
        ]);
    }
}
