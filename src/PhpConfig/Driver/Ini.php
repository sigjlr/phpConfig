<?php

namespace PhpConfig\Driver;

class Ini implements Driver{
	/**
	 * @var string
	 */
	private $filename;
	
	
	public function __construct($filename){
		$this->filename = $filename;
	}
	
	/**
	 * Load the ini config file and return the conficuration array
	 * 
	 * @return array 
	 */
	public function load(){
		return parse_ini_file($this->filename, TRUE);
	}
}
