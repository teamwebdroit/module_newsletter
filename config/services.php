<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => array(
		'domain' => '',
		'secret' => '',
	),

	'mandrill' => array(
		'secret' => '',
	),

	'mailjet' => [
		'api'    => '1fcc01cd3b91600867d8758f43d29e9d',
		'secret' => '6c6078e1aadf033d263fb121144a2925',
	],

	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
