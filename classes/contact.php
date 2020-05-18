<?php
require_once("conn_function.php");
//include_once ('creds.php');
require_once("sql.php");

class personClass{
	
var $contact_vars;


	//constructor
	function personClass()
	{ 
		$this->contact_vars=array(
				'pkperson_id' =>"",
				'firstName' =>"",
				'lastName' =>"",
				'org' =>"",
				'title' =>"",
				'email'=>"",
				'url'=>"",
				'image' =>""
		);
	}
	
	function getContact()
	{
		return $this->contact_vars;
	}
	
	function createContact($contact_vars)
	{	$id='pkperson_id';
		$sql =" Insert into  tblContact";
		$sql .=InsertSQL($contact_vars,$id);
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	function updateContact($vars)
	{	
		//print_r($vars);
		$id='pkcontact_id';
		$sql="UPDATE tblContact SET ";
		$sql.=UpdateSQL($vars,$id);
		$sql .=" where ".$id."=".$vars[$id];
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	
//Individual record
	function getContactById($id)
	{
		$sql="Select * from tblContact where pkcontact_id =".$id;
		$result=getconn($sql);
		return $result;
	}
	
	function getLastContactId()
	{
		$id=mysql_insert_id();
		$result=getconn($sql);
		return $id;
	}
	
}
?>