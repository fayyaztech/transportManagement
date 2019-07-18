<?php 
/* 
 created by fayyaztech 13-02-2019
 * helper auto selecting js according to current page 
 * help to maintain all js at single place
 * maintain js versions to avoid clear catch after updating js 
 */

function load_js($page)
{
	switch ($page) {
		case "vehicle":
			// last updated 13-02-2019 fayyaztech
			make_js($page,1.0);
			break;
		case 'driver':
			make_js($page,1.0);
			break;
		case 'freight':
			make_js($page,1.0);
			break;
		case 'maintenance':
			make_js($page,1.0);
			break;
		case 'route':
			make_js($page,1.0);
			break;
		case 'trip':
			make_js($page,1.0);
			break;
		case 'expense':
			make_js($page,1.0);
			break;
		case 'client':
			make_js($page,1.0);
			break;		
		case 'load':
			make_js($page,1.0);
			break;		
		default:
			make_js('admin',1.0);
			break;
	}
}

function make_js($page,$v)
{
	echo '<script src="'.base_url().'assets/js/custom/'.$page.'.js?v='.$v.'"></script>';
}