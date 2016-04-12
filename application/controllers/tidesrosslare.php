<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tidesrosslare extends CI_Controller {
	

	
	private $control = false;
	public static $counter = 0;
	
	/**
	 * Constructor for Tidesrosslare
	 */
	public function __construct() {
		//Load and fetch tides array for Rosslare Harbour
		parent::__construct();
		$this->load->model('tides_model');
        $this->load->helper('url_helper');
        self::$counter++;
	}
	
	
	
	
	/**
	 * Index page for tides rosslare
	 */
	public function index() {
		
		echo  $this->control;
		
		$array = $this->tides_model->getTodayTideTimes();
		$date = $this->tides_model->dateFormatted;
		$data = array();
		$data[$date] = $date;
		
		
		$data['firstLow'] = $array['firstLow'];
		$data['firstHigh'] = $array['firstHigh'];
		$data['secondLow'] = $array['secondLow'];
		$data['secondHigh'] = $array['secondHigh'];
		$data['button'] = "HEIGHTS";
		$data['status'] = $this->control;
		$this->load->view('tides', $data);
		
	}
	
	/**
	 * Toogle the tide times with the tide heights and vice versa
	 */
	public function swap($arg1='', $arg2='') {
		
			if(isset($arg1) && !empty($arg1)) {
				echo   "This is an arguement"  .$arg1;
			}
			
			if(isset($arg2) && !empty($arg2)) {
				echo   "This is an arguement"  .$arg2;
			}
		
			if(!$this->control) {
			$array = $this->tides_model->getTodayTideHeights();
			$date = $this->tides_model->dateFormatted;
			$data = array();
			$data[$date] = $date;
			
			
			$data['firstLow'] = $array['firstLow'];
			$data['firstHigh'] = $array['firstHigh'];
			$data['secondLow'] = $array['secondLow'];
			$data['secondHigh'] = $array['secondHigh'];
			$data['button'] = "TIMES";
			
			$this->control = true;
			
			$data['status'] = $this->control;
			
			$this->load->view('tides', $data);
			
			
			}else{

			
			$array = $this->tides_model->getTodayTideTimes();
			$date = $this->tides_model->dateFormatted;
			$data = array();
			$data[$date] = $date;
			
			
			$data['firstLow'] = $array['firstLow'];
			$data['firstHigh'] = $array['firstHigh'];
			$data['secondLow'] = $array['secondLow'];
			$data['secondHigh'] = $array['secondHigh'];
			$data['button'] = "HEIGHTS";
			
			$this->control = false;
			
			$data['status'] = $this->control;
			
			$this->load->view('tides', $data);
			
			
			
			}
			
			echo  $this->control;
			
		
		
	}
	
	
	
	
}



?>