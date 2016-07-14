<?php

class MST_Pslider_Block_Adminhtml_Cats_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('pslider_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('pslider')->__('Group Information'));
    }
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('pslider')->__('Group Information'),
            'title' => Mage::helper('pslider')->__('Group Information'),
            'content' => $this->getLayout()->createBlock('pslider/adminhtml_cats_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}