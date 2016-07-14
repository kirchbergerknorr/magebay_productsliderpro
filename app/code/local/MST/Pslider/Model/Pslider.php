<?php

/**
 * PACKT Pslider Model
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Model_Pslider extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('pslider/pslider');
    }
    static public function getTypeArray()
    {
        $arr_status = array(
				array(
                    'value' => 0,
                    'label' => Mage::helper('pslider')->__('--- Select Option ---'),
                ),
                array(
                    'value' => 1,
                    'label' => Mage::helper('pslider')->__('Top Sellers'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('pslider')->__('Top Rated'),
                ),
				array(
                    'value' => 3,
                    'label' => Mage::helper('pslider')->__('Most Viewed'),
                ),
				array(
                    'value' => 4,
                    'label' => Mage::helper('pslider')->__('Latest Products'),
                ),
            );
            
        return  $arr_status;
    }
    static public function getOptionArray()
    {
        $arr_status = array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('pslider')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('pslider')->__('Disabled'),
                ),
            );
            
        return  $arr_status;
    }
	
	/*Get all parent menu fill to select box*/
	protected $category_option = array();
	
	protected $optionsymbol = "";
	public function getChildCategoryCollection($parentId)
    {
		$categories=$this->getCategories();
		$categories->addFieldToFilter("parent_id",$parentId);
    	return $categories;
    }
    public function getCategories()
    {
    	$categories = Mage::getModel('catalog/category')
                    ->getCollection()
                    ->addAttributeToSelect('*')
                    ->addIsActiveFilter();
    	return $categories;
    }
	public function selectRecursiveCategories($parentID)
	{
		$childCollection=$this->getChildCategoryCollection($parentID);
		foreach($childCollection as $value){
			$categoryId=$value->getEntityId();
			//Check this menu has child or not
			$this->optionsymbol=Mage::helper("pslider")->getCategorySpace($categoryId);
			$this->category_option[$categoryId]=$this->optionsymbol.$value->getName();
			$hasChild=$this->getChildCategoryCollection($categoryId);
			if(count($hasChild)>0)
			{
				$this->selectRecursiveCategories($categoryId);
			}
		}
	}
	public function getCategoryOptions()
	{
		$this->category_option[0]= '--- All Products ---';
		$categories=$this->getCategories();
		foreach ($categories as $value) {
			if($value->getParentId()==1){
				$categoryid=$value->getEntityId();
				$this->category_option[$categoryid]=$value->getName();
				//Check has child menu or not
				$hasChild=$this->getChildCategoryCollection($categoryid);
				if(count($hasChild)>0)
				{
					$this->selectRecursiveCategories($categoryid);
				}
			}
		}
		//array_unshift($this->category_option, array('label' => '--Select category--', 'value' => ''));
		return $this->category_option;
	}
	

}