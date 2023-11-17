<?php

namespace Nninvoice\Controller;

use OxidEsales\Eshop\Core\Registry;

class PaymentController extends PaymentController_parent
{
   
    public function render()
    {
        return parent::render();
    }

    
    public function getPaymentList()
    {
        parent::getPaymentList();
        foreach ($this->_oPaymentList as $oPayment) {
            $sCurrentPayment = $oPayment->oxpayments__oxid->value;
           
        }
        return $this->_oPaymentList;
    }


}
