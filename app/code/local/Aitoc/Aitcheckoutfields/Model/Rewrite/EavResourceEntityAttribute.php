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

class Aitoc_Aitcheckoutfields_Model_Rewrite_EavResourceEntityAttribute extends Mage_Eav_Model_Resource_Entity_Attribute 
{
public function isUsedBySuperProducts(Mage_Core_Model_Abstract $object, $attributeSet = null)
    {
        $adapter      = $this->_getReadAdapter();
        $attrTable    = $this->getTable('catalog/product_super_attribute');
        $productTable = $this->getTable('catalog/product');

        $bind = array('attribute_id' => $object->getAttributeId());
        $select = clone $adapter->select();
        $select->reset()
            ->from(array('main_table' => $attrTable), array('psa_count' => 'COUNT(product_super_attribute_id)'))
            ->join(array('entity' => $productTable), 'main_table.product_id = entity.entity_id')
            ->where('main_table.attribute_id = :attribute_id')
            ->group('main_table.attribute_id')
            ->limit(1);

        if ($attributeSet !== null) {
            $bind['attribute_set_id'] = $attributeSet;
            $select->where('entity.attribute_set_id = :attribute_set_id');
        }

        $helper = Mage::getResourceHelper('core');
        $query  = $helper->getQueryUsingAnalyticFunction($select);
        return $adapter->fetchOne($query, $bind);
    }
}