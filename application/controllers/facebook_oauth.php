<?php
class Oauth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->load->config('facebook');

		$facebook_config = array(
			'client_id' 	=> config_item('facebook_app_id'),
			'client_secret'	=> config_item('facebook_secret'),
			'callback_url'	=> base_url().'facebook/oauth',
			'access_token'	=> NULL
		);
			
		$this->load->library('facebook_oauth', $facebook_config);

	}
	
	function index()
	{
		// If Returning from Facebook with "code" in query string
		if (isset($_GET['code']))
		{
			$this->data['result'] = $this->facebook_oauth->getAccessToken($_GET['code']);
		}
		else
		{
			$auth_url = $this->facebook_oauth->getAuthorizeUrl();

			$this->data['result'] =  '<a href="'.$auth_url.'">'.$auth_url.'</a>';	
		}
		
		$this->load->view('facebook_oauth', $this->data);
	
	}

	
}