<?php

/**
 * PACKT Pslider Status Model
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Model_Status extends Varien_Object
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED => Mage::helper('pslider')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('pslider')->__('Disabled')
        );
    }

}