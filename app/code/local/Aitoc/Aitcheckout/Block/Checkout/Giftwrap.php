<?php
/**
 * All-In-One Checkout v1.0.15 : All-In-One Checkout v1.0.15 (OPCB Unit)
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitcheckout / Aitoc_Aitcheckout
 * @version      1.0.15 - 1.4.15
 * @license:     jC7sr77MwqoHj2SDR8w4YXR3o3w7irXLNFUdRYpgyc
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
class Aitoc_Aitcheckout_Block_Checkout_Giftwrap extends Mage_Core_Block_Template
{
    public function isShow()
    {
        return (Mage::helper('aitcheckout/aitgiftwrap')->isEnabled());
    }

    protected function _toHtml()
    {
        if($this->isShow())
        {
            $html = $this->getLayout()
                ->createBlock('aitgiftwrap/giftwrap_onepage')
                ->setTemplate('aitgiftwrap/giftwrap.phtml')
                ->toHtml();
               
            if($html)
            {
                return $html . parent::_toHtml();
            }
        }
        return '';
    }
}