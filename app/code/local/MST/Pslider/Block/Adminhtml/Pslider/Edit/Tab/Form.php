<?php

class MST_Pslider_Block_Adminhtml_Pslider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('pslider_form', array('legend' => Mage::helper('pslider')->__('Item information')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('pslider')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));
     /*   $fieldset->addField('filename', 'file', array(
            'label' => Mage::helper('pslider')->__('File'),
            'required' => false,
            'name' => 'filename',
        ));
		*/
		/*
		$fieldset->addField('filename', 'image', array(
            'label' => Mage::helper('pslider')->__('Image'),
            'required' => false,
			'class' => 'require-entry',
            'name' => 'filename',
        ));
		*/
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
        $fieldset->addField('description', 'editor', array(
            'name' => 'description',
            'label' => Mage::helper('pslider')->__('Description'),
            'title' => Mage::helper('pslider')->__('Description'),
            'style' => 'width:700px; height:150px;',
            'wysiwyg' => false,
            'required' => true,
        ));
        $fieldset->addField('position', 'text', array(
            'label' => Mage::helper('pslider')->__('Position'),
            'class' => '',
            'required' => false,
            'name' => 'position',
        ));
		
		$allcategories = Mage::getModel('pslider/pslider')->getCategoryOptions();
		
		/*
		$categories = array();
    	foreach ($allcategories as $value => $label) {
    		$categories[] = array (
    				'value' => $value,
    				'label' => html_entity_decode($label)
    				);
    	}
		
		$fieldset->addField('categories_id', 'multiselect', array(
				'name'      => 'categories_id[]',
				'label'     => Mage::helper('pslider')->__('Category'),
				'title'     => Mage::helper('pslider')->__('Category'),
				'required'  => false,
				'style'     => 'height:200px',
				'values'    => $categories,
		));
		*/
		
		$fieldset->addField('category_id', 'select', array(
            'label' => Mage::helper('pslider')->__('Category'),
            'name' => 'category_id',
            'values' => $allcategories,
        ));
		
		$type_option = Mage::getSingleton('pslider/pslider')->getTypeArray();
		$fieldset->addField('type_id', 'select', array(
            'label' => Mage::helper('pslider')->__('Type Product'),
            'name' => 'type_id',
            'values' => $type_option,
			'class' => 'required-entry validate-select',
            'required' => true,
        ));

		
        $cats_option = Mage::getSingleton('pslider/cats')->getCatsOptionArray();
		$fieldset->addField('cats_id', 'select', array(
            'label' => Mage::helper('pslider')->__('Group'),
            'name' => 'cats_id',
            'values' => $cats_option,
			'class' => 'required-entry',
            'required' => true,
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