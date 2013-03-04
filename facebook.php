<?php

define("FACEBOOK_PAGE",     "Page");
define("FACEBOOK_ID", 		"ID");
define("FACEBOOK_SECRET", 	"Secret");


class CreodeFacebookData {

	
	protected $data = array();

	public function __get($varName) {
	    if (array_key_exists($name, $this->data)) {
	        return $this->data[$name];
	    }
	}

	public function __set($varName,$varValue) { 
		$this->data[$name] = $value;
	}

	public function getConnectionToken() {

		$url = 'https://graph.facebook.com/oauth/access_token?client_id='.FACEBOOK_ID.'&client_secret='.FACEBOOK_SECRET.'&grant_type=client_credentials';
		$ch = curl_init($url); 
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$response = curl_exec($ch);
		curl_close($ch);   

		if($response) {
			return $accessToken = str_replace('access_token=', '', $response);
		} else {
			return false;
		}
	}

	public function getFacebookData($accessToken) {

		$url = 'https://graph.facebook.com/'.FACEBOOK_ID.'/feed?access_token='.$accessToken;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$response = curl_exec($ch);
		curl_close($ch); 

		if($response) {
			var_dump($response);
			//return $accessToken = str_replace('access_token=', '', $response);
		} else {
			return false;
		}
		
	}

}

?>