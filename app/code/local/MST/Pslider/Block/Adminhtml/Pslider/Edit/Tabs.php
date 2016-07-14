<?php

class MST_Pslider_Block_Adminhtml_Pslider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('pslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('pslider')->__('Item Information'));
    }
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('pslider')->__('Item Information'),
            'title' => Mage::helper('pslider')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('pslider/adminhtml_pslider_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}