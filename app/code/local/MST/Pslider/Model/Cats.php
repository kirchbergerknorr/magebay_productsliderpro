<?php

/**
 * PACKT Pslider Model
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Model_Cats extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('pslider/cats');
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
    
    public function getCatsOptionArray() 
    {
        
        $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('core_read');
        $psliderTable = $resource->getTableName('pslider_cats');
        
        $select = $read->select()
        		->from($psliderTable, array('cats_id', 'title'))
        		->where('status', 1)
        		->order('title ASC');
        $cats = $read->fetchAll($select);
        
        $options = array();
        
		$options[] = array(
			'label' => '--- Select Group ---',
			'value' => ''
		);
        
        if ($all && $this->_isAdminScopeAllowed) {
            $options[] = array(
                'label' => Mage::helper('adminhtml')->__('All Store Views'),
                'value' => 0
            );
        }
        
        $nonEscapableNbspChar = html_entity_decode('&#160;', ENT_NOQUOTES, 'UTF-8');
        
        foreach ( $cats as $cat ) {
            $options[] = array(
                'label' => str_repeat($nonEscapableNbspChar, 4) . $cat['title'],
                'value' => $cat['cats_id']
            );
            
        }
       /* 
        echo '----------<pre>';
        print_r($pslider);
        echo '</pre>';
        foreach ( $pslider as $new  ) {
        	echo $new['title'].'<br>';
        
        } */
        return $options;
        
    }
	
	public function installGuide( $groupId , $layout )
	{
		if ( $layout == 1 ) {  
$html .= '1, To embed Menu Group in CMS/Static Block:

{{block type="catalog/product_list" name="pslider_' . $groupId.'" group_id="' . $groupId . '" template="pslider/tabs-slider.phtml" }}

2, To reference in custom xml:

<block type="catalog/product_list" name="pslider_' . $groupId . '" template="pslider/tabs-slider.phtml">
<action method="setData"><name>group_id</name><value>' . $groupId . '</value></action>
</block>
';
		} elseif ( $layout == 2 ) {  
$html .= '1, To embed Menu Group in CMS/Static Block:

{{block type="catalog/product_list" name="pslider_' . $groupId.'" group_id="' . $groupId . '" template="pslider/list-slider.phtml" }}

2, To reference in custom xml:

<block type="catalog/product_list" name="pslider_' . $groupId . '" template="pslider/list-slider.phtml">
<action method="setData"><name>group_id</name><value>' . $groupId . '</value></action>
</block>
';		
		}

		
		return $html;
	}
	
	

}