<?php

$sMetadataVersion = '2.1';


$aModule = [
        'id'          => 'nninvoice',
        'title'       => [
            'de' => 'Novalnet Invoice',
            'en' => 'Novalnet Invoice',
        ],
        'description' => [ 'de' => 'This Extension for Novalnet Invoice Payment Process',
                           'en' => 'This Extension for Novalnet Invoice Payment Process',
        ],
        'thumbnail'   => 'img/nninvoice.png',
        'version'     => '13.1.0',
        'author'      => 'Novalnet Developer',
        'url'         => 'https://www.novalnet.com',
        'email'       => 'technical@novalnet.de',
        'extend'      => [
           
            
        ],
        'controllers'  => [  
              
            
        ],


        'settings'      => [
            ['group' => 'nninvoiceapiconfiguration', 'name' => 'paymentaccesskey','type' => 'str',   'value'  => '', 'position' => 1 ],
            ['group' => 'nninvoiceapiconfiguration', 'name' => 'productactivationkey',    'type' => 'str',   'value'  => '', 'position' => 2 ],
            ['group' => 'nninvoiceapiconfiguration', 'name' => 'traiffid',    'type' => 'str',   'value'  => '', 'position' => 3 ],
            ['group' => 'nninvoicepayment', 'name' => 'testmode',    'type' => 'bool',    'value' => 'false', 'position' => 1 ],
            ['group' => 'nninvoicepayment', 'name' => 'paymentaction',    'type' => 'bool',    'value' => 'false', 'position' => 2 ],
            ['group' => 'nninvoicepayment', 'name' => 'duedate',    'type' => 'str',   'value'  => '', 'position' => 3 ],
            ['group' => 'nninvoicepayment', 'name' => 'bnrvalue',    'type' => 'str',   'value'  => '', 'position' => 4 ],
            
        ],
        'events'    => [
           
        ],
];
