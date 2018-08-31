<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['configCustom'] = array(

	// Email config
	'email' => array(
		'fromEmail'		=> 'sender@server.com',
		'fromName'		=> 'OrderCount Robot',
		'subject_prefix'=> '',
	),

	// *** IMPORTANT: do not modify the below code *** //

	// Custom items
	'menu' => array(
		array(
			'controller'=> 'dashboard',
			'name'		=> 'Dashboard',
			'ico'		=> 'fa-dashboard',
			'level'		=> 1,
		),
		array(
			'controller'=> 'statistics',
			'name'		=> 'Statistics',
			'ico'		=> 'fa fa-bar-chart',
			'level'		=> 1,
		),
		array(
			'controller'=> 'settings',
			'name'		=> 'Settings',			
			'ico'		=> 'fa-cogs',
			'level'		=> 5,
		),
		array(
			'controller'=> 'user/profile',
			'name'		=> 'Profile',			
			'ico'		=> 'fa-user-circle',
			'level'		=> 1,
		),
		array(
			'controller'=> 'user/logout',
			'name'		=> 'Logout',			
			'ico'		=> 'fa-sign-out',
			'level'		=> 1,
		),
	),

	'userTypeKeyVal'	=> array(
		0 => 'Disable', 
		1 => 'User', 
		9 => 'Admin',
	),

	// Site name
	'siteName'	=> 'OC',

	// Default meta data
	'metaData'	=> array(
		'author'		=> '@fvlgnn',
		'description'	=> '',
		'keywords'		=> '',
		'robots'		=> 'noindex, nofollow'
	),

	// Google Analytics User ID
	'gaId' => '',
    
);