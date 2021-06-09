<?php

namespace Kappafix\Salesforce;

use Kappafix\Salesforce\Authentication\PasswordAuthentication;
use Kappafix\Salesforce\SalesforceFunctions;


class SalesforceWrapper
{
    public $salesforce;
	public $config;
	
	
	/**  Location for overloaded data.  */
    private $data = array();
	
	
	public function __construct(Array $config)
    {	
		
        $this->config = $config;
		$this->salesforce = new PasswordAuthentication($config);
		#Change Endpoint only for test
		$this->salesforce->setEndpoint($config['endPoint']);
		$this->salesforce->authenticate();
		$this->accessToken = $this->salesforce->getAccessToken();
		$this->instanceUrl = $this->salesforce->getInstanceUrl();
		$this->sf = new SalesforceFunctions( $this->config['apiVersion'], $this->instanceUrl, $this->accessToken);
		return $this;
		
		 
    }
	
	
	public function query($query){
		
		$res = $this->sf->query($query);
		
		
		return $res;

	}
	
	
	public function insert(String $objectName, Array $data){
		
		$res = $this->sf->create($objectName, $data);  #returns id
		return $res;

	}

	public function update(String $objectName, String $id, Array $data){
			
			$res = $this->sf->update($objectName, $id, $data);  #returns id
		
			return $res;

		}
	
	public function upsert(String $objectName, String $field, String $id, Array $data){
			
			$res = $this->sf->upsert($objectName, $field, $id, $data);  #returns id
		
			return $res;

		}

	public function delete(String $objectName, String $id){
			
			$res = $this->sf->delete($objectName, $id);  #returns id
		
			return $res;

		}
	
	public function getAccessToken(){
			
			return $this->sf->getAccessToken();

		}
	
	public function getInstanceUrl(){
			
			return $this->sf->getInstanceUrl();

		}
	
	public function customEndpoint(String $customerEndPoint, String $data, Int $httpStatus=200){
			
			return $this->sf->customEndpoint($customerEndPoint, $data, $httpStatus);

		}
	
	
	public function get(String $objectName, String $id){
			
			$res = $this->sf->get($objectName, $id);  #returns array
		
			return $res;

		}
	
	
    
}
