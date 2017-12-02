<?php

return [
    'create_table' => true,
    
    'new_table' => 'orders',
    'new_columns' => [
    	'name' => 'VARCHAR(255)',
    	'last_name' => 'VARCHAR(255)',
    	'address' => 'VARCHAR(255)',
    	'company' => 'VARCHAR(255)',
    	'city' => 'VARCHAR(255)',
    	'zip' => 'VARCHAR(255)',
    	'country' => 'VARCHAR(255)',
    	'email' => 'VARCHAR(255)',
    	'phone' => 'VARCHAR(255)',
    	'quantity' => 'INT(11)',
    	'unit_price' => 'INT(11)',
    	'amount' => 'INT(11)',
    	'shipping' => 'INT(11)',
    	'total' => 'INT(11)',
    	'payment_id' => 'VARCHAR(255)',
    	'approved' => 'BOOLEAN',
    	'status' => 'VARCHAR(255)',
    	'result' => 'TEXT',
    	'created_at' => 'TIMESTAMP NULL DEFAULT NULL',
    	'updated_at' => 'TIMESTAMP NULL DEFAULT NULL',
    ],

    // oszlopol hozzaadasa meglevo tablahoz
    'modify_DB' => false,

    // rekordok hozzaadasa meglevo tablahoz
    'new_record' => true,
    
    'record_table' => 'settings',
    
    'record_columns' => [

    	[
    		'name' => 'paypal_client_id',
        	'content' => '',
        	'type' => 'other',
        	'online' => false
    	],
    	[
    		'name' => 'paypal_secret',
        	'content' => '',
        	'type' => 'other',
        	'online' => false
    	],
        
    ],

    'views' => [
        [
            'name' => 'checkout',
            'belongs_to' => 'PayPal'
        ],
    ],
    
];