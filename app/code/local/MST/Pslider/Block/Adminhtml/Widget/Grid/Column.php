<?php
require_once 'Mage/Adminhtml/Block/Widget/Grid/Column.php';

class MST_Pslider_Block_Adminhtml_Widget_Grid_Column extends Mage_Adminhtml_Block_Widget_Grid_Column {

    protected function _getRendererByType() {
        switch (strtolower($this->getType())) {
            case 'pslider':
                $rendererClass = 'pslider/adminhtml_widget_grid_column_renderer_pslider';
                break;
            default:
                $rendererClass = parent::_getRendererByType();
                break;
        }
        return $rendererClass;
    }

    protected function _getFilterByType() {
        switch (strtolower($this->getType())) {
            case 'pslider':
                $filterClass = 'pslider/adminhtml_widget_grid_column_filter_pslider';
                break;
            default:
                $filterClass = parent::_getFilterByType();
                break;
        }
        return $filterClass;
    }

}