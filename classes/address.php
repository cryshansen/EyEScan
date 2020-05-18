<?php
require_once("conn_function.php");
//include_once ('creds.php');
require_once("sql.php");

class addressClass{
	
var $address_vars;
//var $pagesize=10;

	//constructor
	function addressClass()
	{ 
		$this->address_vars=array(
				'pkaddr_id' =>"",
				'street' =>"",
				'City' =>"",
				'prov' =>"",
				'postal' =>"",
				'country' =>"",
				'addr_type'=>"",
				'fk_personid'=>""
		);
	}
	
	function getAddress()
	{
		return $this->address_vars;
	}
	
	function createAddress($address_vars)
	{	$id='pkqr_id';
		$sql =" Insert into  tblAddress";
		$sql .=InsertSQL($address_vars,$id);
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	function updateAddress($vars)
	{	
		//print_r($vars);
		$id='pkaddr_id';
		$sql="UPDATE tblAddress SET ";
		$sql.=UpdateSQL($vars,$id);
		$sql .=" where ".$id."=".$vars[$id];
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	
//Individual record
	function getAddressById($id)
	{
		$sql="Select * from tblAddress where pkaddr_id =".$id;
		$result=getconn($sql);
		return $result;
	}
	
	function getLastAddressId()
	{
		$id=mysql_insert_id();
		$result=getconn($sql);
		return $id;
	}
	
}
?>
