<?php

abstract class DbRepository
{
	protected $con;

/*********1. PDO Class's instance get ***********/

	public function __construct($con)
	{
		$this->setConnection($con);
	}

	public function setConnection($con)
	{
		$this->con = $con;
	}

/*********2. SQL USE***********/

	public function execute($sql,$params = array())
	{
		$stmt = $this->con->prepare($sql);
		$stmt->execute($params);

		return $stmt;
	}

/*********3. SQL's SELECT only 1 low ***********/

	public function fetch($sql,$params = array())
	{
		return $this->execute($sql,$params)->fetch(PDO::FETCH_ASSOC);
	}

/*********3_1. SQL's SELECT all low***********/

	public function fetchAll($sql,$params = array())
	{
		return $this->execute($sql,$params)->fetchAll(PDO::FETCH_ASSOC);
	}

}