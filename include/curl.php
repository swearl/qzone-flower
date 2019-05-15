<?php
defined("QFLOWER") OR die("Access denied");

class curl {
	public $ch = null;
	public $cookie = [];

	public function setCookie($key, $value) {
		$this->cookie[$key] = $value;
	}

	public function getCookies() {
		$cookies = "";
		foreach($this->cookie as $key => $value) {
			$cookies .= "{$key}={$value};";
		}
		return $cookies;
	}

	public function send($url, $data = []) {
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		if(!empty($this->cookie)) {
			curl_setopt($this->ch, CURLOPT_COOKIE, $this->getCookies());
		}
		if (!empty($data)) {
			curl_setopt($this->ch, CURLOPT_POST, 1);
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
		}
		$output = curl_exec($this->ch);
		curl_close($this->ch);
		return $output;
	}
}