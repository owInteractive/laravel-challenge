<?php

function menuActive($list)
{
	$class = '';
	
	if (in_array(str_replace('-', '_', Request::segment(1)), $list, true)) {
		$class = 'active open';
	}
	return $class;
}