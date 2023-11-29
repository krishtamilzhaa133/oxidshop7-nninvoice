<?php

namespace Nninvoice\Controller;

use Nninvoice\Core\Novalnetutil;

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
           $novalnetUtil = new Novalnetutil();
            if ($novalnetUtil->checkNovalnetPayment($sCurrentPayment)) {
            if ($this->nninvoiceconfiguration() === false) {
                unset($this->_oPaymentList[$sCurrentPayment]);
            }
           
        }
    }

        return $this->_oPaymentList;
    }
    public function nninvoiceconfiguration()
    {
        $novalnetUtil = new Novalnetutil();
        $sProcessActivationKey = $novalnetUtil->backendsettingaccess('productactivationkey');
        $sTariffId = $novalnetUtil->backendsettingaccess('traiffid');
        $sAccessKey = $novalnetUtil->backendsettingaccess('paymentaccesskey');
    
         if (empty($sProcessActivationKey) || empty($sAccessKey) || empty($sTariffId)) {
            return false;
         }
        return true;
    }


}
