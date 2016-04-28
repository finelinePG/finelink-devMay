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
class Aitoc_Aitcheckoutfields_Block_Edit_Tab_Customergroups extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        
        
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('catalog')->__('Customer Groups')));
        
        $customerGroups = Mage::getResourceModel('customer/group_collection')
            ->load()->toOptionArray();

        $found = false;
        foreach ($customerGroups as $group) {
            if ($group['value']==0) {
                $found = true;
            }
        }
        if (!$found) {
            array_unshift($customerGroups, array('value'=>0, 'label'=>Mage::helper('catalogrule')->__('NOT LOGGED IN')));
        }

        $fieldset->addField('customer_group_ids', 'multiselect', array(
            'name'      => 'customer_group_ids[]',
            'label'     => Mage::helper('catalogrule')->__('Customer Groups'),
            'title'     => Mage::helper('catalogrule')->__('Customer Groups'),
            'values'    => $customerGroups,
        ));        
        
        $id = $this->getRequest()->getParam('attribute_id');
        $values = Mage::getModel('aitcheckoutfields/attributecustomergroups')->getGroups((int)$id);
        $form->setValues(array('customer_group_ids'=>$values));
        
        $this->setForm($form);        
    
        return parent::_prepareForm();        
        
    }
}