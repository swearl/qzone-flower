<?php
defined("QFLOWER") OR die("Access denied");

class flower {
	const URL_INFO       = "https://h5.qzone.qq.com/flower/proxy/fcg-bin/fcg_get_user_flowerinfo?platform=2&status=1&type=1";
	const URL_FRIENDS    = "https://h5.qzone.qq.com/flower/proxy/fcg-bin/fcg_get_friends_flower?platform=2&status=1&type=1";
	const URL_USER_PROPS = "https://h5.qzone.qq.com/flower/proxy/cgi-bin/cgi_show_userprop?platform=2&status=1&type=1";
	const URL_USE_PROP   = "https://h5.qzone.qq.com/flower/proxy/cgi-bin/cgi_use_mallprop";
	const URL_PLANT      = "https://h5.qzone.qq.com/flower/proxy/cgi-bin/fg_plant";

	public $curl = null;

	public function __construct() {
		$this->curl = new curl();
		$this->curl->setCookie("p_uin", COOKIE_P_UIN);
		$this->curl->setCookie("p_skey", COOKIE_P_SKEY);
	}

	public function getInfo() {
		$data = $this->curl->send(self::URL_INFO);
		return json_decode($this->_trimCallback($data));
	}

	public function getFriends() {
		$data = $this->curl->send(self::URL_FRIENDS);
		return json_decode($this->_trimCallback($data));
	}

	public function getUserProps() {
		$data = $this->curl->send(self::URL_USER_PROPS);
		$data = mb_convert_encoding($data, "utf-8", "gbk");
		return json_decode($this->_trimCallback($data));
	}

	public function useProp($propid) {
		$format = "json";
		$data = $this->curl->send(self::URL_USE_PROP, compact("format", "propid"));
		$data = mb_convert_encoding($data, "utf-8", "gbk");
		return json_decode($data);
	}

	public function plant($act) {
		$format = "json";
		$data = $this->curl->send(self::URL_PLANT, compact("format", "act"));
		$data = mb_convert_encoding($data, "utf-8", "gbk");
		return json_decode($data);
	}

	private function _trimCallback($data) {
		return trim(preg_replace("/_Callback\((.+)\);/s", "$1", $data));
	}
}