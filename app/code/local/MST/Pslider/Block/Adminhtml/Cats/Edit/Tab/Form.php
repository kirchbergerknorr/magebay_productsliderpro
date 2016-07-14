<?php

class MST_Pslider_Block_Adminhtml_Cats_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('pslider_form', array('legend' => Mage::helper('pslider')->__('Category information')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('pslider')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));
        /*$fieldset->addField('filename', 'file', array(
            'label' => Mage::helper('pslider')->__('File'),
            'required' => false,
            'name' => 'filename',
        ));
		*/
		$fieldset->addField('layout', 'select', array(
            'label' => Mage::helper('pslider')->__('Layout'),
            'name' => 'layout',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('pslider')->__('Tabs Sliders'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('pslider')->__('List Sliders'),
                ),
            ),
        ));
        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('pslider')->__('Status'),
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('pslider')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('pslider')->__('Disabled'),
                ),
            ),
        ));
		/*
        $fieldset->addField('info', 'editor', array(
            'name'      => 'info',
            'label'     => Mage::helper('pslider')->__('How to embed?'),
            'title'     => Mage::helper('pslider')->__('How to embed?'),
			'style' => 'width:700px; height:150px;',
            'wysiwyg' => false,
            'required' => false,
        ));
		*/
		$fieldset->addField('info', 'textarea', array(
	        'name'      => 'info',
			'readonly'	=> true,
			'after_element_html'	=> '<small class="help-install" style="color: red; font-size: 20px;"><div class="config-heading">Click "Save And Continue Edit" button to get embed script!</div></small>'.'<small class="help-note" style="display:none;"><div class="config-heading">Copy above script and paste to where you want to show this group menu!</div></small>',
	        'label'     => Mage::helper('pslider')->__('How to embed?'),
	        'title'     => Mage::helper('pslider')->__('How to embed?'),
	        'style'     => 'width:730px; height:150px;',
	        'wysiwyg'   => false,
	        'required'  => false,
	    ));
		
			
		
        if (Mage::getSingleton('adminhtml/session')->getPsliderData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getPsliderData());
            Mage::getSingleton('adminhtml/session')->setPsliderData(null);
        } elseif (Mage::registry('pslider_data')) {
            $form->setValues(Mage::registry('pslider_data')->getData());
        }
        return parent::_prepareForm();
    }
}