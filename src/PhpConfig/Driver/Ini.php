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
	 * Load the ini config file and return the configuration array
	 * 
	 * @return array 
	 */
	public function load(){
		return parse_ini_file($this->filename, TRUE);
	}
	
	
	
	/**
	 * Save the ini config file changing the key found in the input array.
	 * Comments and blank line are preserved.
	 * 
	 * Only change of value are implemented, no add nor delete is implemented
	 * 
	 * 
	 * @todo Examine sections 
	 * 
	 * @return array $newConfigData 
	 * 
	 * @return 
	 */
	public function save(array $newConfigData){
		//array of rows for he old file
		$fileRows = file($this->filename);
		
		//array of rows for the new file
		$newFileRows = array();

		foreach ($fileRows as $key => $val){
			$newval = trim($val);
			//Copy as is blank line, comment line and section header
			if( $newval=='' || substr($newval, 0,1)==';' || substr($newval, 0,1)=='['){
				$newFileRows[$key] = $val;
			}else{
				$parameter = explode('=', $val);
				$parameter[0] = trim($parameter[0]);
				
				//if ini key is set in newConfigData array change it, otherwise copy as is
				if(isset($newConfigData[$parameter[0]])){
					$newFileRows[$key] = $parameter[0].' = '.$newConfigData[$parameter[0]];
				}else{
					$newFileRows[$key] = $val;
				}
			}
		}
		
		file_put_contents($this->filename, $newFileRows, FILE_TEXT);
		return;
	}
	
	
}
