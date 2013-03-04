<?php
//start of script to turn facebook statues into Yorkshire. Still needs work

class Yorkshire
{
	
	protected $strStatus;
	
	public function statusChange($strStatus)
	{
		
		$strStatus = strtolower($strStatus);
		
		$arrEnglish = 
		             array(
					 "/lookout/", "/have not/", "/wife/", "/girlfriend/", "/nothing/", "/how are you/", 
					 "/any thing/", "/coke/", "/lemonade/", "/think/", "/here/","/right/","/very/","/died/","/close the door/", 
					 "/yorkshire/", "/self/","/isn't/","/was not/","/doesn't/","/ee/","/yes/","/no/","/nothing/","/really/","/with/",
					 "/the /", "/h/"
					 );
					 
		$arrYorkshire = 
		               array(
					   "ey up", "avn't", "gaffer", "gaffer", "nowt", "'ow do", "owt", "pop","pop", 
					   "reckon", "ear","reight","reight","popped 'is cloggs","put wood i'th'oil", "God's Country", 
					   "sen","int", "wont", "dnt","eh","aye lad aye","nah","nout","propah","wi","'", "t'"
					   );
		
		$strNewStatus = preg_replace($arrEnglish, $arrYorkshire, $strStatus);

		$this->strNewStatus = $strNewStatus;
		return $this->GetNewSatus();
	}
}





