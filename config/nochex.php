<?php
	return [
		'nochex_merchant_id'=>env('NOCHEX_MERCHANT_ID','matin1233@yahoo.com'),
		'settings'=>array(
			'nochex_mode'=>env('NOCHEX_MODE','live'),
			'http.ConnectionTimeOut'=>30,
			'log.LogEnabled'=>true,
			'log.FileName'=>storage_path().'/logs/nochex.log',
			'log.LogLevel'=>'ERROR',
		),
	];
?>