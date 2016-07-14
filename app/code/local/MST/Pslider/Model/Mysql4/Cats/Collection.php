<?php

/**
 * PACKT Pslider Collection Model specialized for MySQL4
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Model_Mysql4_Cats_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('pslider/cats');
    }

}