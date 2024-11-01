<?php

// Exit if accessed directly
! defined( 'YITH_WCEUE' )  && exit();

return array(
	'premium' => array(
		'landing' => array(
			'type' => 'custom_tab',
			'action' => 'yith_wceue_premium_tab',
			'hide_sidebar' => true,
		)
	)
);