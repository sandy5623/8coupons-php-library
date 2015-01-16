<?php
/*********
A php library for the 8coupons api

**************/
class Eightcoupons{
	private $developerkey="";
	private $BASEURL="http://api.8coupons.com/v1/";
	public function getCategory(){
		return qet_query("getcategory");
	}
	public function getSubcategory(){
		return get_query("getsubcategory");
	}
	public function getDealtype(){
		return get_query("getdealtype");
	}
	public function getChainStoreList($key){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getchainstorelist", array("key"=>$key));
	}
	public function getRealtimeLocalDeals($key, $page=null){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}else if($page!=null && ($page<1 || is_int($page))){
			throw new Exception("Page parameter needs to be a integer as well as postive");
		}
		return get_query("getrealtimelocaldeals", array("key"=>$key,"page"=>$page));
	}
	public function getRealtimeChainDeals($key){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getrealtimechaindeals", array("key"=>$key));
	}
	public function getRealtimeProductDeals($key){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getrealtimeproductdeals", array("key"=>$key));
	}
	public function getRealtimeTraveldeals($key){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getrealtimetraveleals", array("key"=>$key));
	}
	public function getDealsByLocation($key,$speed=null, $zip="10011",$lat=null,$lon=null, $mileradius="5",$limit="20",$page=null,$orderby="popular",$userid=null,$optoutuserid=null,$categoryid=null,$subcategoryid=null,$dealtypeid=null,$search=null){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getrealtimetraveleals", array("key"=>$key,"zip"=>$zip,"lat"=>$lat,"lon"=>$lon,"mileradius"=>$mileradius,"limit"=>$limit,"page"=>$page,"orderby"=>$orderby,"userid"=>$userid,"optoutuserid"=>$optoutuserid,"categoryid"=>$categoryid,"subcategoryid"=>$subcategoryid,"dealtypeid"=>$dealtypeid,"search"=>$search));
	}
	public function getStoreDeals($key,$storeid=null,$chainid=null){
			if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getstoredeals", array("key"=>$key,"storeID"=>$storeid,"chainID"=>$chainid));	
	}
	public function getDealById($key,$dealid=null){
			if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getdealbyid", array("key"=>$key,"dealID"=>$dealid));	
	}
	public function getStoreInfo($key,$storeid=null,$storename=null,$lat=null,$lon=null,$mileradius=null,$page=null){
		if($key==""){
			throw new Exception("Key parameter is required for this API call!");
		}
		return get_query("getstoreinfo", array("key"=>$key,"storeID"=>$storeid,"storeName"=>$storename,"lat"=>$lat,"lon"=>$lon,"mileradius"=>$mileradius,"page"=>$page));	
	}
	private function get_query($method, $params=null){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $BASEURL+$method+($params!=null ? arrayToParameters($params):""));
		curl_setopt($ch, CURLOPT_USERAGENT, '8Coupons PHP Library');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response=curl_exec($ch);
		curl_close($ch);
		return json_decode($response);
	}
	private function arrayToParameters($array){
		$querystring="";
		foreach($array as $key => $value){
			$querystring+=$key+"="+urlencode($value)+"&";
		}
		return trim($querystring,'&');
	}
}
?>