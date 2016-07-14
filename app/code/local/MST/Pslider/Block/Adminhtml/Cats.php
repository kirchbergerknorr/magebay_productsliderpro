<?php

class MST_Pslider_Block_Adminhtml_Cats extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_cats';
        $this->_blockGroup = 'pslider';
        $this->_headerText = Mage::helper('pslider')->__('Group Manager');
        $this->_addButtonLabel = Mage::helper('pslider')->__('Add Group');
        parent::__construct();
    }

}