<?php


namespace Nninvoice\Core;

use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\DbMetaDataHandler;
use OxidEsales\Eshop\Core\Field;

class Events
{

    public static function onActivate()
    {
        if (!empty($_REQUEST['fnc']) && !preg_match("/activate/i", $_REQUEST['fnc'])) {
            return;
        }
      
        self::addNovalnetInvoicePaymentMethods();
    }

    public static function onDeactivate()
    {
        if (!empty($_REQUEST['fnc']) && !preg_match("/deactivate/i", $_REQUEST['fnc'])) {
            return;
        }
        $oPayment = oxNew(Payment::class);
        $oDb = DatabaseProvider::getDb();
    
        if ($oPayment->load('novalnetinvoice')) {
            $oPayment->oxpayments__oxactive = new Field(0);
            $oPayment->save();
        }

    }

  
    public static function addNovalnetInvoicePaymentMethods()
    {
        $aPayments = [
            'novalnetpayments'  => [
                'OXID'          => 'novalnetinvoice',
                'OXDESC_DE'     => 'Novalnet Invoice',
                'OXDESC_EN'     => 'Novalnet Invoice',
                'OXLONGDESC_DE' => 'This is Novalnet Invoice Payment',
                'OXLONGDESC_EN' => 'This is Novalnet Invoice Payment',
                'OXSORT'        => '2'
            ],
        ];
        $oLangArray = \OxidEsales\Eshop\Core\Registry::getLang()->getLanguageArray();
        $oPayment = oxNew(Payment::class);
        foreach ($oLangArray as $oLang) {
            foreach ($aPayments as $aPayment) {
                $oPayment->setId($aPayment['OXID']);
                $oPayment->setLanguage($oLang->id);
                $sLangAbbr = in_array($oLang->abbr, ['de', 'en']) ? $oLang->abbr : 'en';
                $oPayment->oxpayments__oxid          = new Field($aPayment['OXID']);
                $oPayment->oxpayments__oxtoamount    = new Field('1000000');
                $oPayment->oxpayments__oxaddsumrules = new Field('31');
                $oPayment->oxpayments__oxtspaymentid = new Field('');
                $oPayment->oxpayments__oxdesc     = new Field($aPayment['OXDESC_'. strtoupper($sLangAbbr)]);
                $oPayment->oxpayments__oxlongdesc = new Field($aPayment['OXLONGDESC_'. strtoupper($sLangAbbr)]);
                $oPayment->oxpayments__oxsort = new Field($aPayment['OXSORT']);
                $oPayment->save();
            }
        }
    }


}
