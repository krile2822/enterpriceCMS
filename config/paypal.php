<?php

return [
/** set your paypal credential **/


// 'client_id' =>'AdIjkyjh5_XhGwEm4ldlP9fivIaATvY8tD0uLtXz_eugGNHN37eAJy0ixJ5O59ngJTM5osKlWZa1dSTD',
// 'secret' => 'EFpFjMH8ce0LjvhyoWHrvVoYJrg1qvIVrNi4vZcJ6Ezwl6-5PxVBmCWwMCI0L8rFUExbl4r6VYbE7b_8',

// Read credentials from DB


/**
* SDK configuration 
*/
'settings' => array(
	/**
	* Available option 'sandbox' or 'live'
	*/
	'mode' => 'sandbox',
	
        /**
	* Specify the max request time in seconds
	*/
	'http.ConnectionTimeOut' => 1000,
    
	/**
	* Whether want to log to a file
	*/
	'log.LogEnabled' => true,
    
	/**
	* Specify the file that want to write on
	*/
	'log.FileName' => storage_path() . '/logs/paypal.log',
    
	/**
	* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
	*
	* Logging is most verbose in the 'FINE' level and decreases as you
	* proceed towards ERROR
	*/
	'log.LogLevel' => 'FINE'
	)
];