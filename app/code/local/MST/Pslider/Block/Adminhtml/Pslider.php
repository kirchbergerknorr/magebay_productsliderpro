<?php

class MST_Pslider_Block_Adminhtml_Pslider extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_pslider';
        $this->_blockGroup = 'pslider';
        $this->_headerText = Mage::helper('pslider')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('pslider')->__('Add Item');
        parent::__construct();
    }

}