<?php
/**
 * Created by PhpStorm.
 * User: tonysantucci
 * Date: 7/29/17
 * Time: 3:52 PM
 */

return [

	## TODO:  Create additional drivers.
	'driver' => 'database',

	# Keep log entries for this many days.
	'keepFor' => 90,

	'log' => [
		'enabled' => true,
		'contents' => [
			'request' => [
				'headers' => true,
				'body' => true,
			],
			'response' => [
				'headers' => true,
				'body' => false,
			]
		]
	],
];