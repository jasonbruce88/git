<?php

class whois
{
	protected $strDomain;
	protected $strWhoisServer;
	protected $arrResultsReturn;
	
	function __construct()
	{
		$this->arrResultsReturn = array();
	}
	
	public function setDomain($strDomain) { $this->domain = $strDomain; }
	
	public function getWhoisServer()
	{
		//should be pulled from a db or screen scrapped form an updated source. 
		$arrWhoisServers = array (
			"uk" =>          "whois.nic.uk",
			"com" =>         "whois.internic.net"
		);
		

		$arrDomainSplit = explode(".", $this->domain);
		$strTld = strtolower(array_pop($arrDomainSplit));
		
		$this->strWhoisServer = $arrWhoisServers[$strTld];
		
		if(!$this->strWhoisServer)
		{
			$strError = 'No whois server found';
			return $strError;
		}

		$this->arrResultsReturn['WhoisServer'] = $this->strWhoisServer;
		
		$this->whoisCheck();

		return $this->returnResults();
		
	}
	
	public function whoisCheck()
	{

		$intPort = 43;
		$intTimeOut = 10;
		$fp = @fsockopen($this->strWhoisServer, $intPort, $strErrNo, $strErr, $intTimeOut)
		or die("Socket Error " . $strErrNo . " - " . $strErr);
		
		fwrite($fp, $this->domain . "\r\n");
		$strLookup = fread($fp, 4096);
		
		fclose($fp);

		if($strLookup){
			$this->arrResultsReturn['WhoisResults'] = $strLookup;
			return true;
		} else {
			return false;
		}

	}
	
	public function returnResults()
	{
		
		return $this->arrResultsReturn;
	}
		
}