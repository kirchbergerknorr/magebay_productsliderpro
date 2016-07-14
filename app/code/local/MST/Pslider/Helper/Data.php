<?php

/**
 * PACKT Pslider Data Helper
 *
 * @category   PACKT
 * @package    MST_Pslider
 * @author     Nurul Ferdous <ferdous@dynamicguy.com>
 */
class MST_Pslider_Helper_Data extends Mage_Core_Helper_Abstract
{
	protected static $egridImgDir = null;
    protected static $egridImgURL = null;
    protected static $egridImgThumb = null;
    protected static $egridImgThumbWidth = null;
    protected $_allowedExtensions = Array();

    public function __construct() {
        self::$egridImgDir = Mage::getBaseDir('media') . DS;
        self::$egridImgURL = Mage::getBaseUrl('media');
        self::$egridImgThumb = "thumb/";
        self::$egridImgThumbWidth = 40;
    }
	

	public function updateDirSepereator($path){
        return str_replace('\\', DS, $path);
    }
	
	public function getImageUrl($image_file) {
        $url = false;
        if (file_exists(self::$egridImgDir . self::$egridImgThumb . $this->updateDirSepereator($image_file)))
            $url = self::$egridImgURL . self::$egridImgThumb . $image_file;
        else
            $url = self::$egridImgURL . $image_file;
        return $url;
    }

    public function getFileExists($image_file) {
        $file_exists = false;
        $file_exists = file_exists(self::$egridImgDir . $this->updateDirSepereator($image_file));
        return $file_exists;
    }

    public function getImageThumbSize($image_file) {
        $img_file = $this->updateDirSepereator(self::$egridImgDir . $image_file);
        if ($image_file == '' || !file_exists($img_file))
            return false;
        list($width, $height, $type, $attr) = getimagesize($img_file);
        $a_height = (int) ((self::$egridImgThumbWidth / $width) * $height);
        return Array('width' => self::$egridImgThumbWidth, 'height' => $a_height);
    }

    function deleteFiles($image_file) {
        $pass = true;
        if (!unlink(self::$egridImgDir . $image_file))
            $pass = false;
        if (!unlink(self::$egridImgDir . self::$egridImgThumb . $image_file))
            $pass = false;
        return $pass;
    }
	
	/* edit by David */
	function get_content_id($file,$id){
		$h1tags = preg_match_all("/(<div id=\"{$id}\">)(.*?)(<\/div>)/ismU",$file,$patterns);
		$res = array();
		array_push($res,$patterns[2]);
		array_push($res,count($patterns[2]));
		return $res;
	}
	
	function get_div($file,$id){
    $h1tags = preg_match_all("/(<div.*>)(\w.*)(<\/div>)/ismU",$file,$patterns);
    $res = array();
    array_push($res,$patterns[2]);
    array_push($res,count($patterns[2]));
    return $res;
	}
	
	function get_domain($url)   {   
		$dev = 'dev';
		if ( !preg_match("/^http/", $url) )
			$url = 'http://' . $url;
		if ( $url[strlen($url)-1] != '/' )
			$url .= '/';
		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : ''; 
		if ( preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs) ) { 
			$res = preg_replace('/^www\./', '', $regs['domain'] );
			return $res;
		}   
		return $dev;
	}
	/* end */
	
	
	public function getCategorySpace($categoryid)
	{
		$path = Mage::getModel('catalog/category')->load($categoryid)->getPath();
		$space="";
		$num=explode("/", $path);
		for($i=1; $i<count($num);$i++)
		{
			$space=$space."---";
		}
		return $space;
	}
	
	// Top Sellers
	/* 
	public function getTopSellers($cat_id)
	{
		$storeId    = Mage::app()->getStore()->getId();

		$visibility = array(
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
						  );
		$productCount = 9;
		if ( trim(Mage::getStoreConfig('pslider/setting/maxproduct')) > 0 ) { 
			$productCount = trim(Mage::getStoreConfig('pslider/setting/maxproduct'));
		} 
		if ( $cat_id == 0 ) {
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addOrderedQty()
					->addAttributeToFilter('visibility', $visibility)
					->setOrder('ordered_qty', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		} else {
			$category = Mage::getModel('catalog/category')->load($cat_id);
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addOrderedQty()
					->addCategoryFilter( $category )
					->addAttributeToFilter('visibility', $visibility)
					->setOrder('ordered_qty', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		}
			
		return $_productCollection;
	} */
	
	public function getTopSellers($cat_id)
	{
		$storeId    = Mage::app()->getStore()->getId();

		$visibility = array(
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
						  );
		$productCount = 9;
		if ( trim(Mage::getStoreConfig('pslider/setting/maxproduct')) > 0 ) { 
			$productCount = trim(Mage::getStoreConfig('pslider/setting/maxproduct'));
		} 
		if ( $cat_id == 0 ) {
			/* $_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addOrderedQty()
					->addAttributeToFilter('visibility', $visibility)
					->setOrder('ordered_qty', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
					*/
					
					$storeId = (int) Mage::app()->getStore()->getId();
 
        // Date
        $date = new Zend_Date();
        $toDate = $date->setDay(1)->getDate()->get('Y-MM-dd');
        $fromDate = $date->subMonth(1)->getDate()->get('Y-MM-dd');
 
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect('*')
            ->addStoreFilter()
            ->addPriceData()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->setPageSize($productCount);
 
        $collection->getSelect()
            ->joinLeft(
                array('aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_monthly')),
                "e.entity_id = aggregation.product_id AND aggregation.store_id={$storeId} AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'",
                array('SUM(aggregation.qty_ordered) AS sold_quantity')
            )
            ->group('e.entity_id')
            ->order(array('sold_quantity DESC', 'e.created_at'));
 
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
		$_productCollection = $collection ;
		
		} else {
			/* $category = Mage::getModel('catalog/category')->load($cat_id);
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addOrderedQty()
					->addCategoryFilter( $category )
					->addAttributeToFilter('visibility', $visibility)
					->setOrder('ordered_qty', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);*/
			
			$category = Mage::getModel('catalog/category')->load($cat_id);			
			$collection = Mage::getResourceModel('catalog/product_collection')
				->addAttributeToSelect('*')
				->addStoreFilter()
				->addPriceData()
				->addTaxPercents()
				->addUrlRewrite()
				->addCategoryFilter( $category )
				->setPageSize($productCount);
	 
			$collection->getSelect()
				->joinLeft(
					array('aggregation' => $collection->getResource()->getTable('sales/bestsellers_aggregated_monthly')),
					"e.entity_id = aggregation.product_id AND aggregation.store_id={$storeId} AND aggregation.period BETWEEN '{$fromDate}' AND '{$toDate}'",
					array('SUM(aggregation.qty_ordered) AS sold_quantity')
				)
				->group('e.entity_id')
				->order(array('sold_quantity DESC', 'e.created_at'));
	 
			Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
			Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
			$_productCollection = $collection ;		
		}
			
		return $_productCollection;
	}
	
	public function getLatestProducts($cat_id)
	{
		$storeId    = Mage::app()->getStore()->getId();
		$visibility = array(
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
						  );
		$productCount = 9;
		if ( trim(Mage::getStoreConfig('pslider/setting/maxproduct')) > 0 ) { 
			$productCount = trim(Mage::getStoreConfig('pslider/setting/maxproduct'));
		} 
		if ( $cat_id == 0 ) {
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					//->addOrderedQty()
					->addAttributeToFilter('visibility', $visibility)
					//->setOrder('ordered_qty', 'desc')
					->setOrder('entity_id', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		} else {  
			$category = Mage::getModel('catalog/category')->load($cat_id);
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					//->addOrderedQty()
					->addCategoryFilter( $category )
					->addAttributeToFilter('visibility', $visibility)
					//->setOrder('ordered_qty', 'desc')
					->setOrder('entity_id', 'desc')
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		}
		
		return $_productCollection;
	}
	
	public function getMostViewed($cat_id)
	{
		$storeId    = Mage::app()->getStore()->getId();
		$visibility = array(
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
							  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG
						  );
		$productCount = 9;
		if ( trim(Mage::getStoreConfig('pslider/setting/maxproduct')) > 0 ) { 
			$productCount = trim(Mage::getStoreConfig('pslider/setting/maxproduct'));
		}
		if ( $cat_id == 0 ) {  
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addViewsCount()
					->addAttributeToFilter('visibility', $visibility)
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		} else {
			$category = Mage::getModel('catalog/category')->load($cat_id);
			$_productCollection = Mage::getResourceModel('reports/product_collection')
					->addAttributeToSelect('*')     
					->setStoreId($storeId)
					->addStoreFilter($storeId)
					->addViewsCount()
					->addCategoryFilter( $category )
					->addAttributeToFilter('visibility', $visibility)
					->setPageSize($productCount)->load();
			Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
			Mage::getSingleton('catalog/product_visibility')
					->addVisibleInCatalogFilterToCollection($_productCollection);
		}
		
		return $_productCollection;
	}
	
	public function getTopRated($cat_id)
	{
		$orderfeild='rating_summary';
		$order='desc';
		$productCount=9;
		if ( trim(Mage::getStoreConfig('pslider/setting/maxproduct')) > 0 ) { 
			$productCount = trim(Mage::getStoreConfig('pslider/setting/maxproduct'));
		}
		$currentPage=1;
		 
		$storeId = Mage::app()->getStore()->getId();
		$entityCondition = '_reviewed_order_table.entity_id = e.entity_id';
		
		if ( $cat_id == 0 ) {  
			$_productCollection = Mage::getResourceModel('catalog/product_collection')
					->setStoreId($storeId)
					->addAttributeToSelect('*')
					->addStoreFilter($storeId)
					;
		} else {  
			$category = Mage::getModel('catalog/category')->load($cat_id);
			$_productCollection = Mage::getResourceModel('catalog/product_collection')
						->setStoreId($storeId)
						->addAttributeToSelect('*')
						->addStoreFilter($storeId)
						->addCategoryFilter( $category )
						;
		}
		
					
					
		$_productCollection->getSelect()->joinLeft(
							array('_reviewed_order_table'=>$_productCollection->getTable('review_entity_summary')),
									"_reviewed_order_table.store_id=$storeId AND _reviewed_order_table.entity_pk_value=e.entity_id",
							array()
						);
		$_productCollection->getSelect()->order("_reviewed_order_table.$orderfeild $order");	
		$_productCollection->getSelect()->group('e.entity_id');		
		$_productCollection->setPageSize($productCount)->setCurPage($currentPage);
		Mage::getSingleton('catalog/product_status')
					->addVisibleFilterToCollection($_productCollection);
		Mage::getSingleton('catalog/product_visibility')
				->addVisibleInCatalogFilterToCollection($_productCollection);
			
		return $_productCollection;
				
	}
	
}