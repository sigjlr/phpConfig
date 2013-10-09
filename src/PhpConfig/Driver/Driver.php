<?php

namespace PhpConfig\Driver;

/**
 * Describes a driver instance
 *
 * 
 */
 
interface Driver {
	
	/**
	 * Load the configuration file and return the configuration array
	 * 
	 * @return array
	 */
	public function load();
	
	
	/**
	 * Change the configuration file
	 * 
	 * @return
	 */
	public function save();
}