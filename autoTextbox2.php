<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>
 <script src="_inc/jquery-1.3.2.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnOfficial").click(
			function() {
                var hdValue = $("#theValue");
                var num = ($("#theValue").val() - 1) + 2;
                hdValue.val(num);
                var newDiv = $(document.createElement('div')).attr("id", 'my' + num + 'Div');
				var newDiv2 = $(document.createElement('div')).attr("id", 'my' + num + 'Div2');
                newDiv.after().html('<input type="text"  name="txtTel' + num + '" value="Phone' + num + '" >');
				//newDiv.after().html('<input type="text"  name="TextBox' + num + '" value="TextBox' + num + '" >');
				newDiv2.after().html('<select name="ddtel' + num + '" ><option value=""></option><option value="WORK">Work</option><option value="WORK;Type=FAX">Work Fax</option><option  value="HOME">Home</option><option  value="HOME;Type=FAX">Home Fax</option><option  value="CELL">CELL</option> <option  value="MAIN">MAIN</option><option  value="PAGER">PAGER</option></select>');
                newDiv.appendTo("#Div1");
				newDiv2.appendTo("#Div2");

            });
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

$txtTel='';
$ddTel = '';
 if(isset($_POST['btnSubmit']) !='')
 {
	 
	 print_r($_POST);
	 for($i=1; $i <= $_POST['telValue'];$i++)
	 {
	 	$postName = 'txtTel'.$i;
	 	$txtTel[$i] = $_POST[$postName];
	 }
	 for($j=1;$j <= $_POST['telValue'];$j++)
	 {
		 $postName2 = 'ddtel'.$j;
	 	$ddTel[$j] = $_POST[$postName2];
		 
	}
	 print_r($txtTel);print_r($ddTel);
}else
{
	
	echo "false";
	}


 ?>
    <form id="form1" method="post" action="autoTextbox2.php">
    <table>
        <tr>
            <td>
            <div id="Div1">
            </div></td>
            <td>
            <div id="Div2">
            </div></td>
        </tr>
    </table>
    <input type="button" id="btnOfficial" value="Add Another TextBox" />
    <input type="hidden" name="telValue" value="1" id="theValue" runat="server" />
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
</html>
