<?php

class MST_Pslider_Block_Adminhtml_Cats_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'pslider';
        $this->_controller = 'adminhtml_cats';

        $this->_updateButton('save', 'label', Mage::helper('pslider')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('pslider')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
            ), -100);
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('pslider_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'pslider_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'pslider_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
	
	protected function _prepareLayout()
    {
        // Load Wysiwyg on demand and Prepare layout
      //  if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled() && ($block = $this->getLayout()->getBlock('head'))) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
       // }
        return parent::_prepareLayout();
    }

    public function getHeaderText()
    {
        if (Mage::registry('pslider_data') && Mage::registry('pslider_data')->getId()) {
            return Mage::helper('pslider')->__("Edit Category '%s'", $this->htmlEscape(Mage::registry('pslider_data')->getTitle()));
        } else {
            return Mage::helper('pslider')->__('Add Group');
        }
    }
}