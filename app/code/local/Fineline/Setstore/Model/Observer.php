<?php

class Fineline_Setstore_Model_Observer extends Varien_Event_Observer
{
  public function setstore($observer)
  {
      if(Mage::getSingleton('customer/session')->isLoggedIn())
      {
        $groupId = Mage::getSingleton('customer/session')->getCustomerGroupId(); //get the group id
        if($groupId == 4) //set group ID here.
        {
          Mage::app()->setCurrentStore(4); //Set id of the store view without vat
        }
        else {
          Mage::app()->setCurrentStore(2); //set the store view with vat
        }
      }
  }
}

?>