<?php
//interface for different sites
class ScrapeClass
{

	function __construct($targetURL, $userAgent){
		$this->target_url = $targetURL;
		$this->userAgent = $userAgent;
	}
	
	public function setopt(&$ch)
	{
		curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
		curl_setopt($ch, CURLOPT_URL,$this->target_url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
		return; 
	}
	
	public function setURL($targetURL)
	{
		$this->target_url = $targetURL; 
	}
	
	public function parseHTML($html)
	{
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		echo $html;
	}
	
	public $target_url; 
	public $userAgent;
}

function getCitibikeData()
{
	$targetURL = "http://citibikenyc.com/stations/json";
	$userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
	$scrape = new ScrapeClass($targetURL, $userAgent);
	$ch = curl_init();
	$scrape->setopt($ch);
	$html= curl_exec($ch);
	echo $html; 
}

getCitibikeData();

?>