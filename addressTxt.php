<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

 <script src="_inc/jquery-1.3.2.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
			$("#btnAddress").click(
			function() {
                var hdValue2 = $("#addrValue");
                var num2 = ($("#addrValue").val() - 1) + 2;
                hdValue2.val(num2);
				var newDiv3 = $(document.createElement('div')).attr("id", 'my' + num2 + 'Div3');
				var newDiv4 = $(document.createElement('div')).attr("id", 'my' + num2 + 'Div4');
                newDiv3.after().html('<input type="text"  name="addrStreet' + num2 + '" value="AddressStreet' + num2 + '" ><input type="text"  name="addrCity' + num2 + '" value="AddressCity' + num2 + '" ><input type="text"  name="addrProvState' + num2 + '" value="Prov' + num2 + '" ><input type="text"  name="addrPostal' + num2 + '" value="Postal' + num2 + '" ><input type="text"  name="addrCountry' + num2 + '" value="Country' + num2 + '" >');
				newDiv4.after().html('<select name="addrT' + num2 + '"><option value=""></option><option value="WORK">Work</option><option  value="HOME">Home</option></select>');
				
				newDiv3.appendTo("#Div3");
				newDiv4.appendTo("#Div4");
			
			});
			
        });
    </script>

</head>
<body>
<?php

$txtAddress='';
$ddTel = '';


 if(isset($_POST['btnSubmit']) !='')
 {
	 $addrString='';
	 
	 print_r($_POST);
	 for($k=1; $k<=$_POST['addrValue'];$k++)
	 {	//set up vars for address
	 	$postAddr = 'addrStreet'.$k;
		if($_POST[postAddr] != $postAddr){
			if($k==2){
				$addrString ='ADR;'; 
			}else{
				$addrString .='ADR;'; 
			}
			//need these vars to collect txtvalues
	 		$addrCity = 'addrCity'.$k;
			$addrProvState = 'addrProvState'.$k;
			$addrPostal = 'addrPostal'.$k;
			$addrCountry = 'addrCountry'.$k;
			$ddAdrTypeName2 = 'addrT'.$k;
			if($_POST[$ddAdrTypeName2] !=''){
				//check if dropdown selected
				$addrString .='TYPE='.$_POST[$ddAdrTypeName2].':;;';
			}
	 	//$txtAddress[$k] = $_POST[$postName];
			$addrString .= $_POST[$postAddr]. ';'.$_POST[$addrCity]. ';'.$_POST[$addrProvState]. ';'.$_POST[$addrPostal]. ';'.$_POST[$addrCountry].'%0A';
			
				
		
		}
		
	 }
	 echo $addrString;
}else
{
	
	echo "false";
	}


 ?>
    <form id="form1" method="post" action="addressTxt.php">
   
    <table>
        <tr>
            <td>
            <div id="Div3">
            </div></td>
            <td>
            <div id="Div4">
            </div></td>
        </tr>
    </table>
    <input type="button" id="btnAddress" value="Add Another Address" />
    <input type="hidden" name="addrValue" value="1" id="addrValue" runat="server" />
    
    
    <input type="submit" name="btnSubmit" >
    </form>

</body>