<?php

namespace Nninvoice\Model;
use Nninvoice\Core\Novalnetutil;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleConfigurationDaoBridgeInterface;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Core\Registry;



class Order extends Order_parent
{
    public function finalizeOrder(Basket $oBasket, $oUser, $blRecalculatingOrder = false)
    {

        if (!preg_match("/novalnetinvoice/i", $oBasket->getPaymentId())) {
            
            return parent::finalizeOrder($oBasket, $oUser, $blRecalculatingOrder);
        } else {
      
            return $this->handleFinalizeOrderProcess($oBasket, $oUser, $blRecalculatingOrder);   
        }   
    }
    public function handleFinalizeOrderProcess($oBasket, $oUser, $blRecalculatingOrder){
      
        $novalnetUtil = new Novalnetutil();
         
        $getpaymentid=$oBasket->getPaymentId(); 
       
        $url = $novalnetUtil->endpoint('Payment');
        
        $data= $novalnetUtil->build_payment_params($oUser,$oBasket,$getpaymentid);
        $response=$novalnetUtil->send_payment_request($data,$url);
        // echo "<pre>";
        // print_r($response);
        // die();
        $novalnet_status = $response->result->status;
        $novalnet_status_text = $response->result->status_text;

        if($novalnet_status=='SUCCESS'){ 
             $novalnet_invoice_details = $novalnetUtil->getInvoiceComments($response);
        //      print_r($novalnet_invoice_details);
           
        //    die()
        return parent::finalizeOrder($oBasket, $oUser, $blRecalculatingOrder);
    }
    else{
             
        $redirectUrl = sprintf(
            "%sindex.php?type=error&cl=payment&payerror=-50&payerrortext=%s",
            Registry::getConfig()->getShopSecureHomeURL(),$novalnet_status_text);
            Registry::getUtils()->redirect($redirectUrl, true, 302);
    }

    }
}

