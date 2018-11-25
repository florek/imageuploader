<?php

class Florczak_ImageUploader_Block_Adminhtml_Images_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('imageuploader_image_grid');
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
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }

    /**
     * @param $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('imageuploader/image')
            ->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('id', [
            'header' => $this->__('Id'),
            'index' => 'id',
            'width' => '20px'
        ]);
        $this->addColumn('image', [
            'header' => $this->__('Image'),
            'filter' => false,
            'sortable' => false,
            'width' => '70px',
            'renderer' => 'imageuploader/adminhtml_images_grid_column_image'
        ]);
        $this->addColumn('file_name', [
            'header' => $this->__('File Name'),
            'index' => 'file_name',
            'width' => '70px'
        ]);
        $statusService = Mage::getModel('imageuploader/services_image_status');
        /* @var $statusService Florczak_ImageUploader_Model_Services_Image_Status */
        $this->addColumn('status', [
            'header' => $this->__('Status'),
            'index' => 'status',
            'width' => '70px',
            'type' => 'options',
            'options' => $statusService->getStatuses()
        ]);
        $this->addColumn('action', [
            'actions' => [
                [
                    'caption' => $this->__('Accept Image'),
                    'confirm' => $this->__('Are you sure?'),
                    'field' => 'id',
                    'url' => [
                        'base' => '*/adminhtml_images/acceptImage'
                    ],
                ],
                [
                    'caption' => $this->__('Reject Image'),
                    'confirm' => $this->__('Are you sure?'),
                    'field' => 'id',
                    'url' => [
                        'base' => '*/adminhtml_images/rejectImage'
                    ],
                ]
            ],
            'align' => 'center',
            'getter' => 'getId',
            'header' => $this->__('Action'),
            'sortable' => false,
            'type' => 'action',
            'width' => '50px',
            'filter' => false
        ]);
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('image_massaction');
        $this->getMassactionBlock()->addItem('delete', [
            'label' => $this->__('Delete'),
            'url' => $this->getUrl('imageuploader/adminhtml_images_mass/massDelete', []),
            'confirm' => $this->__('Are you sure?')
        ]);
        $this->getMassactionBlock()->addItem('accept', [
            'label' => $this->__('Accept'),
            'url' => $this->getUrl('imageuploader/adminhtml_images_mass/massAccept', []),
            'confirm' => $this->__('Are you sure?')
        ]);
        $this->getMassactionBlock()->addItem('reject', [
            'label' => $this->__('Reject'),
            'url' => $this->getUrl('imageuploader/adminhtml_images_mass/massReject', []),
            'confirm' => $this->__('Are you sure?')
        ]);
    }
}
