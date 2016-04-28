<?php
/**
 * Product Units and Quantities
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitunits
 * @version      1.0.11
 * @license:     0JdTQfDMswel7fbpH42tkXIHe3fixI4GH3daX0aDVf
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
/**
 * @copyright  Copyright (c) 2012 AITOC, Inc. 
 */
/* AITOC static rewrite inserts start */
/* $meta=%default,Aitoc_Aiteditablecart% */
if(Mage::helper('core')->isModuleEnabled('Aitoc_Aiteditablecart')){
    class Aitoc_Aitunits_Block_Rewrite_CheckoutCartItemRenderer_Aittmp extends Aitoc_Aiteditablecart_Block_Rewrite_FrontCheckoutCartItemRenderer {} 
 }else{
    /* default extends start */
    class Aitoc_Aitunits_Block_Rewrite_CheckoutCartItemRenderer_Aittmp extends Mage_Checkout_Block_Cart_Item_Renderer {}
    /* default extends end */
}

/* AITOC static rewrite inserts end */
class Aitoc_Aitunits_Block_Rewrite_CheckoutCartItemRenderer extends Aitoc_Aitunits_Block_Rewrite_CheckoutCartItemRenderer_Aittmp
{
    
    protected function _toHtml()
    {
        $html = parent::_toHtml();
        $html = Mage::helper('aitunits/event')->addAfterToHtml($html,$this);
        return $html;
    }
}