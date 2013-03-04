<?php
//a quick little port scanner
  $host = $_SERVER['REMOTE_ADDR'];
    for($i=80;$i<90;$i++) { 
		$fp = fsockopen($host,$i,$errno,$errstr,2);
		if($fp)
		  {
			  echo "port " . $i . " open on " . $host . "\n";
			  fclose($fp);
		  }
		  else
		  {
			  echo "port " . $i . " closed on " . $host . "\n";
		  }
		  flush();
	}
	
?>
