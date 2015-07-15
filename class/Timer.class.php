<?php

class Timer {
	// Précis à la microseconde près.
	// Utilisation:
	//   $myTime = Timer::start();
	//   ... code à chronométrer
	//   echo 'Timer: '.$myTime->stop().'&nbsp;seconde<br>';
	private $_start;
	private $_stop;
	public function __construct(){
		$this->_start = microtime(true);
	}
	public static function start(){
		return new Timer();
	}
	public function stop(){
		$this->_stop = microtime(true);
		return $this->time();
	}
	public function time(){
		return self::format($this->_stop - $this->_start);
	}
	public static function pageLoad(){
		$time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
		return self::format($time);
		echo "Création de page en ".Timer::pageLoad()." seconde";
	}
	public static function format($time){
		return number_format($time, 6,',',' ');
	}
}
