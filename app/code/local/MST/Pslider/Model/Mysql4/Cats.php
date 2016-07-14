<?php

/**
 * PACKT Pslider Model specialized for MySQL4
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Model_Mysql4_Cats extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        // Note that the pslider_id refers to the key field in your database table.
        $this->_init('pslider/cats', 'cats_id');
    }

}