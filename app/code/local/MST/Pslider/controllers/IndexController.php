<?php

/**
 * PACKT Pslider index controller
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
    /*    $resource = Mage::getSingleton('core/resource');
        $read = $resource->getConnection('core_read');
        $psliderTable = $resource->getTableName('pslider');

        $select = $read->select()
                ->from($psliderTable, array('pslider_id', 'title', 'filename', 'description', 'content', 'status'))
                ->where('status', 1)
                ->order('created_time DESC');

        $pslider = $read->fetchAll($select);
        Mage::register('list', $pslider);
*/
        $this->loadLayout();
        $this->renderLayout();
    }

    public function viewAction()
    {
        $pslider_id = $this->getRequest()->getParam('id');

        if ($pslider_id != null && $pslider_id != '') {
            $pslider = Mage::getModel('pslider/pslider')->load($pslider_id)->getData();
        } else {
            $pslider = null;
        }

        /**
         * If no param we load a the last created item
         */
        if ($pslider == null) {
            $resource = Mage::getSingleton('core/resource');
            $read = $resource->getConnection('core_read');
            $psliderTable = $resource->getTableName('pslider');

            $select = $read->select()
                    ->from($psliderTable, array('pslider_id', 'filename', 'title', 'description' , 'content_new', 'status', 'update_time'))
                    ->where('status', 1)
                    ->order('created_time DESC');

            $pslider = $read->fetchRow($select);
        }

        Mage::register('pslider', $pslider);


        $this->loadLayout();
        $this->renderLayout();
    }
	
	public function catAction()
    {
        $pslider_id = $this->getRequest()->getParam('id');


         /*   $resource = Mage::getSingleton('core/resource');
            $read = $resource->getConnection('core_read');
            $psliderTable = $resource->getTableName('pslider');

            $select = $read->select()
                    ->from($psliderTable, array('pslider_id', 'filename', 'title', 'description' , 'content', 'status', 'update_time'))
                    ->where('cats_id = ?', 4)
					->where('status = ?', 1)
                    ->order('created_time DESC');

            $pslider = $read->fetchAll($select);
			*/
			
			$pslider = Mage::getModel('pslider/pslider')->getCollection();
			$pslider->getSelect()->where('cats_id = ?', $pslider_id)->where('status = ?', 1);
        

        Mage::register('cat', $pslider);
		

        $this->loadLayout();
        $this->renderLayout();
    }
	
	

} // end of class