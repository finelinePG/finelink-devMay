<?php
/**
 * All-In-One Checkout v1.0.15 : All-In-One Checkout v1.0.15 (CFM Unit)
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitcheckout / Aitoc_Aitcheckoutfields
 * @version      1.0.15 - 2.9.15
 * @license:     jC7sr77MwqoHj2SDR8w4YXR3o3w7irXLNFUdRYpgyc
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
/**
* @copyright  Copyright (c) 2011 AITOC, Inc. 
*/

class Aitoc_Aitcheckoutfields_Block_Widget_Grid_Column_Renderer_Store extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    protected $_skipAllStoresLabel = false;
    protected $_skipEmptyStoresLabel = false;

    /**
     * Retrieve System Store model
     *
     * @return Mage_Adminhtml_Model_System_Store
     */
    protected function _getStoreModel()
    {
        return Mage::getSingleton('adminhtml/system_store');
    }

    /**
     * Retrieve 'show all stores label' flag
     *
     * @return bool
     */
    protected function _getShowAllStoresLabelFlag()
    {
        return $this->getColumn()->getData('skipAllStoresLabel')
            ? $this->getColumn()->getData('skipAllStoresLabel')
            : $this->_skipAllStoresLabel;
    }

    /**
     * Retrieve 'show empty stores label' flag
     *
     * @return bool
     */
    protected function _getShowEmptyStoresLabelFlag()
    {
        return $this->getColumn()->getData('skipEmptyStoresLabel')
            ? $this->getColumn()->getData('skipEmptyStoresLabel')
            : $this->_skipEmptyStoresLabel;
    }

    /**
     * Render row store views
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
     
        $out = '';
        $skipAllStoresLabel = $this->_getShowAllStoresLabelFlag();
        $skipEmptyStoresLabel = $this->_getShowEmptyStoresLabelFlag();
        $origStores = $row->getData('store_id');
		
        if (is_null($origStores) && $row->getStoreName()) {
            $scopes = array();
            foreach (explode("\n", $row->getStoreName()) as $k => $label) {
                $scopes[] = str_repeat('&nbsp;', $k * 3) . $label;
            }
            
            $out .= implode('<br/>', $scopes) . $this->__(' [deleted]');
            return $out;
        }

        if (empty($origStores)&& !$skipEmptyStoresLabel) {
            return '';
        }
        if (!is_array($origStores)) {
            $origStores = array($origStores);
        }

        if (empty($origStores)) {
            return '';
        }
        elseif (in_array(0, $origStores) && count($origStores) == 1 && !$skipAllStoresLabel) {
            return Mage::helper('adminhtml')->__('All Store Views');
        }

        $data = $this->_getStoreModel()->getStoresStructure(false, $origStores);

        foreach ($data as $website) {
            $out .= $website['label'] . '<br/>';
            foreach ($website['children'] as $group) {
                $out .= str_repeat('&nbsp;', 3) . $group['label'] . '<br/>';
                foreach ($group['children'] as $store) {
                    $out .= str_repeat('&nbsp;', 6) . $store['label'] . '<br/>';
                }
            }
        }

        return $out;
    }

    /**
     * Render row store views for export
     *
     * @param Varien_Object $row
     * @return string
     */
    public function renderExport(Varien_Object $row)
    {
        $out = '';
        $skipAllStoresLabel = $this->_getShowAllStoresLabelFlag();
        $origStores = $row->getData($this->getColumn()->getIndex());

        if (is_null($origStores) && $row->getStoreName()) {
            $scopes = array();
            foreach (explode("\n", $row->getStoreName()) as $k => $label) {
                $scopes[] = str_repeat(' ', $k * 3) . $label;
            }
            $out .= implode("\r\n", $scopes) . $this->__(' [deleted]');
            return $out;
        }

        if (!is_array($origStores)) {
            $origStores = array($origStores);
        }

        if (in_array(0, $origStores) && !$skipAllStoresLabel) {
            return Mage::helper('adminhtml')->__('All Store Views');
        }

        $data = $this->_getStoreModel()->getStoresStructure(false, $origStores);

        foreach ($data as $website) {
            $out .= $website['label'] . "\r\n";
            foreach ($website['children'] as $group) {
                $out .= str_repeat(' ', 3) . $group['label'] . "\r\n";
                foreach ($group['children'] as $store) {
                    $out .= str_repeat(' ', 6) . $store['label'] . "\r\n";
                }
            }
        }

        return $out;
    }
}