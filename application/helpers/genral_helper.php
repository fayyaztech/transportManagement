<?php

/* Genral helper

created by fayyaztech 13-02-2019

* make work easier and fast to configure
*/ 


function title()
{
	// common title for whole website 
	echo "Transport Management System";
}

function assets_url($file_name)
{
	echo base_url("assets/");
}

function template($ctx,$page = "templates/error_404",$vers = array())
{
	/* template help to load header and footer every where without making function in every controller
		* $ctx is context of current controller
		* $page name of page which is display page view
		* $verse is an array which is use to send data in view file
		*/
		$ctx->load->view('templates/header');
		$ctx->load->view($page,$vers);
		$ctx->load->view('templates/footer',['js' => $page]);
}

function alphabet_array()
{
	return array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
}

