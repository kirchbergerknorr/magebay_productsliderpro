<?php
class MST_Pslider_Block_Adminhtml_Pslider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('psliderGrid');
        $this->setDefaultSort('cats_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('pslider/pslider')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('pslider_id', array(
            'header' => Mage::helper('pslider')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'pslider_id',
        ));
		/*
        $this->addColumn('filename', array(
            'header' => Mage::helper('pslider')->__('Image'),
            'align' => 'center',
            'index' => 'filename',
            'type' => 'pslider',
            'escape' => true,
            'sortable' => false,
            'width' => '100px',
        ));
		*/
		$this->addColumn('cats_id', array(
            'header' => Mage::helper('pslider')->__('Group Id'),
            'align' => 'left',
            'index' => 'cats_id',
        ));
		$this->addColumn('title', array(
            'header' => Mage::helper('pslider')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));
		
		$this->addColumn('description', array(
            'header' => Mage::helper('pslider')->__('Description'),
            'align' => 'left',
            'index' => 'description',
        ));
		$this->addColumn('position', array(
            'header' => Mage::helper('pslider')->__('Position'),
            'align' => 'left',
            'index' => 'position',
        ));
        /*
          $this->addColumn('content', array(
          'header'    => Mage::helper('pslider')->__('Item Content'),
          'width'     => '150px',
          'index'     => 'content',
          ));
         */
        $this->addColumn('status', array(
            'header' => Mage::helper('pslider')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action',
            array(
                'header' => Mage::helper('pslider')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('pslider')->__('Edit'),
                        'url' => array('base' => '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('pslider')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('pslider')->__('XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('pslider_id');
        $this->getMassactionBlock()->setFormFieldName('pslider');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('pslider')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('pslider')->__('Are you sure?')
        ));
        $statuses = Mage::getSingleton('pslider/status')->getOptionArray();
        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('pslider')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('pslider')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}