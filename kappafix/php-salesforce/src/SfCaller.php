<?php
 
namespace Kappafix\Salesforce;
use Kappafix\Salesforce\SalesforceWrapper;

class SfCaller
{
    
	
    public $data = array();
	public $config;
	
	
	public function __construct(Array $config)
    {	
		$this->config = $config;
		 
    }
	
	public function __get($name)
    {

		$this->data["objectName"] = $name;
		
		return $this;
		

    }
	
	public function __call($name, $arguments)
    {

		$this->data["method"] = $name;
		$this->data["arguments"] = $arguments;
		$sf = new SalesforceWrapper($this->config);
		
		if(!array_key_exists ('objectName', $this->data) || $this->data['objectName'] == null){
			
			return call_user_func_array(array($sf,$this->data['method']), $this->data['arguments']);

			
		} 
		
		#adding the name of the Object at the top of the array
		array_unshift($this->data['arguments'],$this->data['objectName']);
		return call_user_func_array(array($sf, $this->data['method']), $this->data['arguments']);
		
		
		
    }

		
}
