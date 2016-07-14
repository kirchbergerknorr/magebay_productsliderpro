<?php

class MST_Pslider_Block_Pslider extends Mage_Core_Block_Template
{
	public function __construct()
	{
		parent::__construct();
		$pslider = Mage::getModel('pslider/pslider')->getCollection();
	//	$pslider->getSelect()->where('status = ?', 2);
		if ( Mage::registry('cat') ) {
			$this->setCollection(Mage::registry('cat'));
		} else {
			$this->setCollection($pslider);
		}
		
	}

    public function _prepareLayout()
    {
         parent::_prepareLayout();
		$pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
		$pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
		$pager->setCollection($this->getCollection());
		$this->setChild('pager', $pager);
		$this->getCollection()->load();
		return $this;
    }
	public function getPagerHtml()
	{
		return $this->getChildHtml('pager');
	}

    public function getPslider()
    {
        if (!$this->hasData('pslider')) {
            $this->setData('pslider', Mage::registry('pslider'));
        }
        return $this->getData('pslider');
    }

    public function getPsliderList()
    {
        if (!$this->hasData('list')) {
            $this->setData('list', Mage::registry('list'));
        }
        return $this->getData('list');
    }

    function limitCharacter($string, $limit = 20, $suffix = ' . . .')
    {
        $string = strip_tags($string);

        if (strlen($string) < $limit) {
            return $string;
        }

        for ($i = $limit; $i >= 0; $i--) {
            $c = $string[$i];
            if ($c == ' ' OR $c == "\n") {
                return substr($string, 0, $i) . $suffix;
            }
        }

        return substr($string, 0, $limit) . $suffix;
    }
	/* Get Data Nav Cats */
    
    function getNav() {
        $pslider = Mage::getModel('pslider/cats')->getCollection();
        return $pslider;
    }
    

	
	

}