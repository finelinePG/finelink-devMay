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
class Aitoc_Aitcheckoutfields_Block_Rewrite_FrontSalesRecurringProfileView  extends Mage_Sales_Block_Recurring_Profile_View
{
	public function getRecurringProfileCustomData()
    {
        $iStoreId = $this->geRecurringProfile()->getStoreId();

        $oFront = Mage::app()->getFrontController();
	
        $iRecProfileId = $oFront->getRequest()->getParam('profile');
        
        $oAitcheckoutfields  = Mage::getModel('aitcheckoutfields/aitcheckoutfields');

        $aCustomAtrrList = $oAitcheckoutfields->getRecurringProfileCustomData($iRecProfileId, $iStoreId, false, true);

        $this->_shouldRenderInfo = true;
		foreach ($aCustomAtrrList as $aItem)
        {
            if($aItem['value'])
		    {
		        $this->_addInfo(array(
                    'label' => $aItem['label'],
                    'value' => $aItem['value'],
                ));
			}
		}
		
		$viewLabel = Mage::getStoreConfig('aitcheckoutfields/common_settings/aitcheckoutfields_additionalblock_label', $this->getStoreId());
		$this->setViewLabel($viewLabel);
    }
	
	public function geRecurringProfile()
    {
        return Mage::registry('current_recurring_profile');
    }
}
?>