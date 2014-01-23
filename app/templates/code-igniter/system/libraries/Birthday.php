<?php

class Birthday {

	const API_URL_CLIENT = 'http://nwshare.ph/internal-settings/admin/data/client';
	const API_URL_NUWORKS = 'http://nwshare.ph/internal-settings/admin/data/nuworks';
	private $_curl;

	public function __construct() {

		$this->_curl = curl_init();

	}

	public function get_client($search=false) {

		if($search) {

			print_r($search);

		}


		curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->_curl, CURLOPT_URL, self::API_URL_CLIENT);
		$result = curl_exec($this->_curl);
		curl_close($this->_curl);

		return json_decode($result, true);

	}

	public function get_nuworks() {

	}


	public function update_client() {

	}


	public function update_nuworks() {

	}


	private function bday() {

		curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->_curl, CURLOPT_URL, self::API_URL);
		$result = curl_exec($this->_curl);
		curl_close($this->_curl);

	}


}

?>