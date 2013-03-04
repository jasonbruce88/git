<?php
//simple script to return a set of images form a database, and return one at a random size
class jasonBruce {

	protected $mysqlConnect;
	protected $mysqlTable;
	
	
	function __construct()
	{
	  //again when database set up is in own class this will not be in the construct
	  $this->mysqlConnect =  mysql_connect("*", "*", "*");
	  $this->mysqlTable = mysql_select_db("*");
	  $this->mysqlConnect or die(mysql_error());
	  $this->mysqlTable or die(mysql_error());
	}
	
	public function imageGet() {
	  
	  $strCharacterSelect = "
	  select *
	  FROM
	  work
	  ORDER BY
	  RAND()";

	  $arrResult = mysql_query($strCharacterSelect);
	  
	  while($row = mysql_fetch_array( $arrResult ))
	  {
	  	$work_info[] = array('sm_img' => $row['sm_img'], 'med_img' => $row['med_img'], 
	  										'large_img' => $row['large_img'], 'full_img' => $row['full_img'], 
	  										'url' => $row['url'], 'description' => $row['description'], 'name'=>$row['name']);		
	  }

	  if(is_null($work_info))
	  	return false;
	else
		$this->parseHtml($work_info);

	}

	public function parseHtml($work_info) {

		$html = '';
		$html .= '<div id="container"  class="relative">';
		$html .= '<div class="masonry-brick images">';
			$html .= '<img src ="work/jason.jpg" style="padding:5px" />';
		$html .= '</div>';
		foreach($work_info as $work) {
			$img_size = $this->size();
			$html .= '<div class="masonry-brick images">';
				if($img_size == 'work_small') {
					$html .= '<a href="work/'.$work['full_img'].' target="_blank">';
						$html .= '<img src ="work/'.$work['sm_img'].'"" style="padding:5px" />';
					$html .= '</a>';
				}	
				if($img_size == 'work_meddium') {
					$html .= '<a href="work/'.$work['full_img'].'" target="_blank">';
						$html .= '<img src ="work/'.$work['med_img'].'" style="padding:5px" />';
					$html .= '</a>';
				}
				if($img_size == 'work_large') {
					$html .= '<a href="work/'.$work['full_img'].'" target="_blank">';
						$html .= '<img src ="work/'.$work['large_img'].'" style="padding:5px" />';
					$html .= '</a>';
				}
				//parse description
				$html .= '<div class="text-holder">';
				$html .= '<div class="image-name">';
					$html .='<p>';
						$html .= $work['name'];
					$html .='</p>';
				$html .= '</div>';
					$html .= '<div class="description">';
						$html .='<p>';
							$html .= $work['description'];
						$html .='</p>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		}
		$html .= '</div>';
		echo $html;



	//function to get the size of the work image
	public function size() {
		$rand_number = rand(1,99);
		$lg_number = 3;
		$med_number = 2;

		if($rand_number % $lg_number) {
			$img_size = 'work_meddium';
		} elseif($rand_number % $med_number) {
			$img_size = 'work_large';
		} else {
			$img_size = 'work_small';
		}
		return $img_size;
	}

}


?>