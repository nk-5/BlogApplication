<?php

class DbManager{

	protected $connections = array();					// 1
	protected $repository_connection_map = array(); 	// 2
	protected $repositories = array();				// 3

	/*********1. DB Connection Manager***********/

	public function connect($name,$params){
		$params = array_merge(array(
			'dsn'	   =>	null,
			'user'	   =>	'',
			'password' =>	'',
			'options'  =>	array(),
		),$params);

		$con = new PDO(
			$params['dsn'],
			$params['user'],
			$params['password'],
			$params['options']
		);

		$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$this->connections[$name] = $con;
	}

	public function getConnection($name = null){
		if(is_null($name)){
			return current($this->connections);
		}

		return $this->connections[$name];
	}

	/*********2. Repository Class's Connection Mapping***********/

	public function setRepositoryConnectionMap($repository_name,$name){
		$this->repository_connection_map[$repository_name] = $name;
	}


	public function getConnectionForRepository($repository_name){
		if(isset($this->repository_connection_map[$repository_name])){
			$name = $this->repository_connection_map[$repository_name];
			$con = $this->getConnection($name);
		}else{
			$con = $this->getConnection();
		}

		return $con;
	}


	/*********3. Repository Class's Manager***********/
	
	 public function get($repository_name)
	 {
	 	if(!isset($this->repositories[$repository_name])){
	 		$repository_class = $repository_name . 'Repository';
	 		$con = $this->getConnectionForRepository($repository_name);

	 		$repository = new $repository_class($con);

	 		$this->repositories[$repository_name] = $repository;
	 	}

	 	return $this->repositories[$repository_name];
	 }

	/*********4. DB Manager Destruct***********/

	public function __destruct(){
		foreach ($this->repositories as $repository) {
			unset($repository);
		}

		foreach ($this->connections as $con) {
			unset($con);
		}
	}
}