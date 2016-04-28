
/**
 * All-In-One Checkout v1.0.15 : All-In-One Checkout v1.0.15 (OPCB Unit)
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitcheckout / Aitoc_Aitcheckout
 * @version      1.0.15 - 1.4.15
 * @license:     n/a
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
var AitAddress = Class.create(Step,  
{
    newAddress: function(isNew, containerId)
    {
        if (isNew) 
        {
            Element.show(containerId);
        } else {
            Element.hide(containerId);
        }
    },
    
    initAddress: function(savedAddressId, newAddressContainerId, addressType)
    {        
        //observe address selection change events 
        if ($(savedAddressId)) 
        {
            $(savedAddressId).observe('change', function(event) 
            {
                this.newAddress(!Event.element(event).value, newAddressContainerId);
                if (Event.element(event).value) {  
                    aitCheckout.getStep(addressType + 'location').update();
                }
                  
            }.bind(this));                       
        }       
        //observe address fields change events
        this.initEvents(newAddressContainerId);        
    },

    initAdditional: function(containerID)
    {
        this.initEvents(containerID);   
    }
    
});