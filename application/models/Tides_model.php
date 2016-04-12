<?php
require_once 'simple_html_dom.php';

class Tides_model extends CI_Model {
	
	public $final = array();
	private $tide_json = array();
	public $dateFormatted = "";
	
	private $tidesRosslare = "";//stores HTML tide page
	
	public $tide_times = array();//stores tide times
	public $tide_heights = array();//stores tide heights
	
	
	//private $tides = array();
	
	
	
	
	/**
	 * Fetch the page containing tide information for Rosslare
	 */
	public function __construct() {
		
		$this->setDate();
		
		$tide_string = fopen("http://www.ntslf.org/tides/tidepred?port=Rosslare", "r");
		
		//$this->tidesRosslare = file_get_html("http://www.ntslf.org/tides/tidepred?port=Rosslare");
		
		if(isset($tide_string) && !empty($tide_string)) {
			$this->assemble_tides($tide_string);
			
		}
	}
	
	/**
	 * Get todays tide times
	 * @return array
	 */
	public function getTodayTideTimes() {  
		
		$tides = array();
		
		$first = $this->final[$this->dateFormatted][0];
		$second = $this->final[$this->dateFormatted][1];
		$third = $this->final[$this->dateFormatted][2];
		$fourth = $this->final[$this->dateFormatted][3];
		
		if(strchr($first,'L')) {
			$tides['firstLow'] = substr($first, 0, strlen($first)-1);
			$tides['firstHigh'] = substr($second, 0,  strlen($second)-1);
			$tides['secondLow'] = substr($third, 0, strlen($third)-1);
			$tides['secondHigh'] = substr($fourth, 0, strlen($fourth)-1);
		}else{
			$tides['firstHigh'] = substr($first, 0, strlen($first)-1);
			$tides['firstLow'] = substr($second, 0, strlen($second)-1);
			$tides['secondHigh'] = substr($third, 0,  strlen($third)-1);
			$tides['secondLow'] = substr($fourth, 0, strlen($fourth)-1);
		}
		
		
		
		return $tides;
		
		
	}
	
	/**
	 * Get todays tide heights
	 * @return array
	 */
	public function getTodayTideHeights() {
	
		$tides = array();
		
		$first = $this->final[$this->dateFormatted][4];
		$second = $this->final[$this->dateFormatted][5];
		$third = $this->final[$this->dateFormatted][6];
		$fourth = $this->final[$this->dateFormatted][7];
		
		if(strchr($first,'L')) {
			$tides['firstLow'] = substr($first, 0, strlen($first)-1);
			$tides['firstHigh'] = substr($second, 0,  strlen($second)-1);
			$tides['secondLow'] = substr($third, 0, strlen($third)-1);
			$tides['secondHigh'] = substr($fourth, 0, strlen($fourth)-1);
		}else{
			$tides['firstHigh'] = substr($first, 0, strlen($first)-1);
			$tides['firstLow'] = substr($second, 0, strlen($second)-1);
			$tides['secondHigh'] = substr($third, 0,  strlen($third)-1);
			$tides['secondLow'] = substr($fourth, 0, strlen($fourth)-1);
		}
		
		
		
		return $tides;
	
	
	}
	
	/**
	 * Print the captured page
	 */
	public function printTides() {
		
		 var_dump($this->dateFormatted);
	}
	
	private function assemble_tides($string) {
		
			
		if(isset($string)) {
			
		
				
			while(!feof($string))  {
				$text = 	fgets($string);
				//This regex captures tide times
				$times = preg_match_all('/[0-9][0-9][:][0-9][0-9]/', $text, $matches1);
					
				//This regex captures tide heights
				$heights = preg_match_all("/[0-9][.][0-9]{2}[m]&nbsp;[LH]/", $text, $matches);
					
				//$words = preg_match_all('/\d{1}.\d{2}m\s/', $text, $matches);
					
				if ($times > 0 ) {
					//Push the tide times into the tides array
					array_push($this->tide_times, $matches1[0]);
				}
					
				if ($heights > 0 ) {
					//Push the tide heights into the heights array
					array_push($this->tide_heights, $matches[0]);
				}
				
				
			}
				
				
		}
	
		$this->compile_JSON();
	}
	
	private function setDate() {
		
		$timezone = new \DateTimeZone("Europe/London");//Create new time zone for Ireland
		$date = 	new \DateTime("now" , $timezone);//Get todays date using timezone
		$this->dateFormatted =  $date->format('Y-n-j');//Format the date
	}
	
	
	private function compile_JSON() {
		
		$arrayMisc = array();
	
		$outer_count = sizeof($this->tide_times);//Total of records in array (28)
	
		$timezone = new \DateTimeZone("Europe/London");//Create new time zone for Ireland
		$date = 	new \DateTime("now" , $timezone);//Get todays date using timezone
		$string =  $date->format('Y-n-j');//Format the date
	
		for($i = 0; $i < $outer_count; $i++) {
			$time_data =  $this->tide_times[$i];
			$height_data = $this->tide_heights[$i];
			$count = sizeof($time_data);
			$time1 = "";
			$time2 = "";
			$time3 = "";
			$time4 = "";
			$height1 = "";
			$height2 = "";
			$height3 = "";
			$height4 = "";
				
			if($count == 3) {
				//If there are only three tides of this date run this logic
				$height1 = $height_data[0];
				$height2 = $height_data[1];
				$height3 = $height_data[2];
				$height4 = "-.-";
	
				if(stripos($height1, "H") === false) {
					$time1 = $time_data[0] . " L";
				}else {
					$time1 = $time_data[0] . " H";
				}
	
				if(stripos($height2, "H") === false) {
					$time2 = $time_data[1] . " L";
				}else {
					$time2 = $time_data[1] . " H";
				}
	
				if(stripos($height3, "H") === false) {
					$time3 = $time_data[2] . " L";
				}else {
					$time3 = $time_data[2] . " H";
				}
	
				$time4 = "-:-";
	
			}else {
	
				//If there are four tides on this date run this logic
				$height1 = $height_data[0];
				$height2 = $height_data[1];
				$height3 = $height_data[2];
				$height4 = $height_data[3];
	
				if(stripos($height1, "H") === false) {
					$time1 = $time_data[0] . " L";
				}else {
					$time1 = $time_data[0] . " H";
				}
	
				if(stripos($height2, "H") === false) {
					$time2 = $time_data[1] . " L";
				}else {
					$time2 = $time_data[1] . " H";
				}
	
				if(stripos($height3, "H") === false) {
					$time3 = $time_data[2] . " L";
				}else {
					$time3 = $time_data[2] . " H";
				}
	
				if(stripos($height4, "H") === false) {
					$time4 = $time_data[3] . " L";
				}else {
					$time4 = $time_data[3] . " H";
				}
	
			}
	
				
			//Assemble the json formatted tides data for todays date and write to the external file
			$this->final[$string] = array($time1, $time2, $time3, $time4, $height1, $height2, $height3, $height4);
			//$tides[$string] = array($time1, $time2, $time3, $time4, $height1, $height2, $height3, $height4);
			//array_push($this->tide_json, $tides);
			//file_put_contents('filename.txt', json_encode($tides));
			//$this->tide_json = json_encode($tides);
	
			//$this->tidesString .= $tides;
			 
			$date->modify("+1 day");
			$string =  $date->format('Y-n-j');
	
	
			 
	
	
	
		}
		
		$this->tide_json = json_encode($this->final );
	
		
	
	}
	

	


	
	
	
	
	
	
}



?>