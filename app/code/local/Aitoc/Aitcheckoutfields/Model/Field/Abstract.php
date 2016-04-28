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
abstract class Aitoc_Aitcheckoutfields_Model_Field_Abstract extends Mage_Core_Model_Abstract
{
    protected $_eventObject = 'field';
    
    protected $_attribute;
    
    protected $_fieldType;
    
    public function getFieldType()
    {
        return $this->_fieldType;
    }
    
    public function getAttribute()
    {
        if(is_null($this->_attribute) && $this->getAttributeId())
        {
            $this->_attribute = Mage::getModel('eav/entity_attribute')->load($this->getAttributeId());
        }
        return $this->_attribute;
    }
    
    public function getAttributeCode()
    {
        return $this->getAttribute()->getAttributeCode();
    }
}