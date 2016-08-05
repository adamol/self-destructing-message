<?php

return [
	'url' => 'http://localhost:8888',
	'db' => [
		'mysql' => [
			'host' => 'localhost',
			'dbname' => 'destructor',
			'username' => 'root',
			'password' => 'root',
		],
	],
	'services' => [
		'mailgun' => [
			'domain' => 'sandboxc8186689a6dd47e59d12999145f8e354.mailgun.org',
			'secret' => 'key-e32c8b9998f7d6a197d08b85f0c8ebd3'
		]
	]
];