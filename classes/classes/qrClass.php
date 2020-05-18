<?php
require_once("conn_function.php");
//include_once ('creds.php');
require_once("sql.php");

class qrClass{
	
var $qr_vars;
var $pagesize=10;

	//constructor
	function qrClass()
	{ 
		$this->qr_vars=array(
				'vCard' =>'vCard:',
				'n' =>'N:',
				'org' =>'ORG:',
				'tel' =>'TEL:',
				'email' =>'EMAIL:',
				'addr' =>'ADR:',
				'url' =>'URL:'
				//'NOTE' =>:Company%20site:%20http://www.bluelinerny.com;
		);
		//array('pkapplicant_id'=>"",'contact_lname'=>"",'contact_fname'=>"",'app_type'=>"",'organization_name'=>"",'address'=>"",'phone'=>"",'phone2'=>"",'fax'=>"",'email'=>"",'foip'=>"");

	}
	function createQR($qr_vars)
	{	$id='pkqr_id';
		$sql =" Insert into  tblqr";
		$sql .=InsertSQL($qr_vars,$id);
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	function updateApplicant($vars)
	{	
		//print_r($vars);
		$id='pkapplicant_id';
		$sql="UPDATE tblapplicant SET ";
		$sql.=UpdateSQL($vars,$id);
		$sql .=" where ".$id."=".$vars[$id];
		//echo $sql;
		$result = getconn($sql);
		return $result;
	}
	
	function getAllQRs($currpg,$url)
	{
		$sql="Select * from tblapplicant Order By contact_fname, contact_lname";
		$result = paging($sql,$currpg,$this->pagesize,$url); 
		return $result;
	}
	//Individual record
	function getAllQR()
	{
		$sql="Select * from tblapplicant Order By contact_fname, contact_lname";
		$result = getconn($sql); 
		return $result;
	}
//Individual record
	function getQRById($id)
	{
		$sql="Select * from tblapplicant where pkapplicant_id =".$id;
		$result=getconn($sql);
		return $result;
	}
	
	function getLastQRId()
	{
		$id=mysql_insert_id();
		$result=getconn($sql);
		return $id;
	}
	function getQRByCriteria($vars,$currpg,$url)
	{		
			$sql="select * from tblapplicant where contact_lname like '%%%" .$vars['keywd']. "%%%' or contact_fname like '%%%" . $vars['keywd'] ."%%%' or organization_name like '%%%". $vars['keywd'] ."%%%' or address like '%%%".$vars['keywd']. "%%%' ORDER BY organization_name, contact_fname, contact_lname";
			//echo $sql;
			$result = paging($sql,$currpg,$this->pagesize,$url); 
			return $result;
	}
	
	function getQR()
	{
		return $this->qr_vars;
	}
}
?>
