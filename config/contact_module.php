<?php

return [
    'create_table' => true,
    
    'new_table' => 'emails',
    'new_columns' => [
    	'name' => 'VARCHAR(255)',
    	'email' => 'VARCHAR(255)',
    	'message' => 'TEXT',
    	'created_at' => 'TIMESTAMP NULL DEFAULT NULL',
    	'updated_at' => 'TIMESTAMP NULL DEFAULT NULL',
    ],

    'modify_DB' => false,

    'new_record' => true,
    
    'record_table' => 'settings',
    
    'record_columns' => [

    	[
    		'name' => 'email_address_for_feedback',
        	'content' => '',
        	'type' => 'other',
        	'online' => false
    	],
        
    ],

    'views' => [
        [
            'name' => 'contact-form',
            'belongs_to' => 'Contact'
        ],
    ],
    
];
