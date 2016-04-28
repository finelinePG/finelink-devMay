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
class Aitoc_Aitcheckout_Model_Observer
{
    public function onPredispatchCheckoutOnepageIndex(Varien_Event_Observer $observer)
    {
        if(!$this->_checkRule() || Mage::helper('aitcheckout')->isDisabled())return;
        $helper = Mage::helper('aitcheckout');
        $checkoutUrl = Mage::getUrl($helper->getCheckoutUrl(), array('_secure'=>true));
        $observer->getEvent()->getControllerAction()->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
        $observer->getEvent()->getControllerAction()->getResponse()->setRedirect($checkoutUrl);
    }

    public function onPredispatchCheckoutCartIndex(Varien_Event_Observer $observer)
    {
        if(!$this->_checkRule() || Mage::helper('aitcheckout')->isDisabled()) return;

        $helper = Mage::helper('aitcheckout');
        $cartUrl = Mage::getUrl($helper->getCartUrl(), array('_secure'=>true));
        if ($helper->isShowCartInCheckout() || $helper->isNeedRedirectToSecure())
        {
            $observer->getEvent()->getControllerAction()->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);
            $observer->getEvent()->getControllerAction()->getResponse()->setRedirect($cartUrl);
        }
    }

    private function _checkRule()
    {
        /* {#AITOC_COMMENT_END#}
        $iStoreId = Mage::app()->getStore()->getId();
        $iSiteId  = Mage::app()->getWebsite()->getId();
        $performer = Aitoc_Aitsys_Abstract_Service::get()->platform()->getModule('Aitoc_Aitcheckout')->getLicense()->getPerformer();
        $ruler     = $performer->getRuler();
        if (!($ruler->checkRule('store', $iStoreId, 'store') || $ruler->checkRule('store', $iSiteId, 'website')))
        {
            return false;
        }
        {#AITOC_COMMENT_START#} */

        return true;
    }
	
	public function updateQuote(Varien_Event_Observer $observer)
    {
        $quote = $observer->getQuote();
        if($quote instanceof Mage_Sales_Model_Quote)
        {
            $countryId = $quote->getBillingAddress()->getCountryId();
            if(empty($countryId))
            {
                $quote->getBillingAddress()->setCountryId(Mage::helper('aitcheckout')->getDefaultCountry());
            }
        }
    }

    public function onCustomerLogin(Varien_Event_Observer $observer)
    {
        /**
         * Reset checkout method to avoid "The password cannot be empty" error
         * If checkout method was set to "register" before customer logged in
         */

        $customer = $observer->getEvent()->getCustomer();
        if (!$customer->getId())
        {
            return;
        }

        $quote = Mage::getSingleton('checkout/session')->getQuote();
        if (!$quote->getId())
        {
            return;
        }

        $quote->setCheckoutMethod(null)
            ->save();
    }

    public function reloadShippingMethods ($observer)
    {
        if($observer->getBlock() instanceof Mage_Checkout_Block_Onepage_Shipping_Method_Available)
        {
            $quote = Mage::getSingleton('checkout/session')->getQuote();
            $quote->setTotalsCollectedFlag(false);
            $quote->collectTotals()->save();
        }
    }

    public function setDefaultShippingMethod($observer)
    {
        if($observer->getData('action') instanceof Mage_Checkout_CartController ||
            $observer->getData('action') instanceof Aitoc_Aitcheckout_CheckoutController)
        {
            Mage::helper('aitcheckout')->setDefaultShippingMethod();
        }
    }
}