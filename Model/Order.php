<?php

namespace Nninvoice\Model;

use OxidEsales\Eshop\Application\Model\Basket;

//now all payment is not display go to meta data file command extend order then work
class Order extends Order_parent
{
    public function finalizeOrder(Basket $oBasket, $oUser, $blRecalculatingOrder = false)
    {
        // Trigger an event before finalizing the order
        $this->onBeforeFinalizeOrder();

        // Continue with the Oxid order finalization
        parent::finalizeOrder();
       
    }

    protected function onBeforeFinalizeOrder()
    {
        // Your custom code here
        // For example, you can log a message
        error_log("Hello from onBeforeFinalizeOrder");
        return 0;
    }
}
