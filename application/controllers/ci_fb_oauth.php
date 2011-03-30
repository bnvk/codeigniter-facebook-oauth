<?php

class CI_FB_OAuth extends CI_Controller {

    function __construct() {
    
        parent::__construct();

		$this->load->config('facebook');

		$facebook_config = array(
			'client_id' 	=> config_item('facebook_app_id'),
			'client_secret'	=> config_item('facebook_secret_key'),
			'callback_url'	=> base_url(),
			'access_token'	=> NULL
		);
			
		$this->load->library('facebook_oauth', $facebook_config);

	}
	
	function index() {
			
		$data = array();
		
		if (isset($_GET['code'])) {
						
			$this->data['token'] = $this->facebook_oauth->getAccessToken($_GET['code']);
			$this->data['me'] = $this->facebook_oauth->get('/me');
			//$this->data['friends'] = $this->facebook_oauth->get('/me/friends');
		
			$parameters = array(
			
				"message" => "This post came from my app!"
			
			);	
			
			$this->data['post'] = $this->facebook_oauth->post('/me/feed', $parameters);
			
			$this->load->vars('data', $this->data);
			$this->load->view('facebook_oauth_results', $this->data);
				
		
		} else {
		
			$scope = "publish_stream,offline_access,publish_stream";
			
			$this->data['auth_url'] = $this->facebook_oauth->getAuthorizeUrl($scope);
			
			$this->load->vars('data', $this->data);
			$this->load->view('facebook_oauth', $this->data);
			
		}
	
	}

	
}