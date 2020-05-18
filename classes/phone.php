<?php
require_once("conn_function.php");
//include_once ('creds.php');
require_once("sql.php");

class phoneClass{
	
var $phone_vars;
//var $pagesize=10;

	//constructor
	function phoneClass()
	{ 
		$this->phone_vars=array(
				'pkphone_id' =>"",
				'number' =>"",
				'ph_type' =>"",
				'fk_personid'=>""
		);
	}
	
	function getPhone()
	{
		return $this->phone_vars;
	}
	
	function createPhone($phone_vars)
	{	$id='pkphone_id';
		$sql =" Insert into  tblPhone";
		$sql .=InsertSQL($phone_vars,$id);
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	function updatePhone($vars)
	{	
		//print_r($vars);
		$id='pkphone_id';
		$sql="UPDATE tblPhone SET ";
		$sql.=UpdateSQL($vars,$id);
		$sql .=" where ".$id."=".$vars[$id];
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	
//Individual record
	function getPhoneById($id)
	{
		$sql="Select * from tblPhone where pkphone_id =".$id;
		$result=getconn($sql);
		return $result;
	}
	
	function getLastPhoneId()
	{
		$id=mysql_insert_id();
		$result=getconn($sql);
		return $id;
	}
	
}
?>