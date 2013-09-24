<?php

namespace PhpConfig;


class PhpConfig{
	/**
	 * The configuration data
	 *
	 * @var array
	 */
    protected $config = array();

	/**
	 * Array of resources to load 
	 *
	 * @var array
	 */
    protected $resources = array();
	
	
    /**
	 * @param 
	 */
    public function __construct()
    {
        
    }
	
	
    /**
	 * Add a list of resource file to configuration.
	 *
	 * @param $string 
	 */
    public function addResource()
    {
        $params = func_get_args();
		foreach ($params as $param) {
			$this->resources[] = $param;
		}
    }	
	
	
	/**
	 * Return the list of resources
	 *
	 * @param 
	 */
    public function getResource()
    {
        return $this->resources;
    }	
	
	
	/**
	 * Return the configuration data
	 *
	 * @param 
	 */
    public function getConfig()
    {
        return $this->config;
    }	
	
	
	/**
	 * Load all resourced from the first and merge the resultant configuration
	 */
    public function load()
    {
        foreach ($this->resources as $resource) {
            $resourceType = __NAMESPACE__.'\\Driver\\'.$this->identify($resource);
			$cr = new $resourceType($resource);
			
			$this->mergeConfig($cr->load());
        }
    }	
	
	
	/**
	 * Return the type of resource
	 *
	 * @param string $resource
	 * 
	 * @return string
	 */
    private function identify($resource)
    {
     	$current = explode('.', $resource);
		$extension = $current[count($current)-1];
		
		$result = null;
		switch ($extension) {
			case 'ini':
				$result = 'Ini';
				break;
			default:
				throw new Exception('Unknown resource type', 1);
				break;
		}
		return $result;
    }
	

	/**
	 * Merge the new configuration with the existent one.
	 * If in the new configuration is present the same key of the existent one, this is overwrite.
	 *
	 * @param array $newconfig
	 */
    private function mergeConfig(array $newconfig)
    {
    	foreach ($newconfig as $key => $value) {
    		if(isset($this->config[$key])){
    			foreach ($newconfig[$key] as $k=> $v){
    				$this->config[$key][$k] = $v;
    			}
				unset ($newconfig[$key]);
    		}
		}
     	$this->config = array_merge($this->config, $newconfig);
    }
	
}
