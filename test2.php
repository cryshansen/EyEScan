<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script src="_inc/jquery-1.3.2.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#btnOfficial").click(function() {
                var hdValue = $("#theValue");
                var num = ($("#theValue").val() - 1) + 2;
                hdValue.val(num);
                var newDiv = $(document.createElement('div')).attr("id", 'my' + num + 'Div');
				var newDiv2 = $(document.createElement('div')).attr("id", 'my' + num + 'Div2');
                newDiv.after().html('<input type="text"  name="phone' + num + '" value="Phone' + num + '" >');
				//newDiv.after().html('<input type="text"  name="TextBox' + num + '" value="TextBox' + num + '" >');
				newDiv2.after().html('<select name="addrt' + num + '" ><option value=""></option><option value="WORK">Work</option><option value="WORK;Type=FAX">Work Fax</option><option  value="HOME">Home</option><option  value="HOME;Type=FAX">Home Fax</option><option  value="CELL">CELL</option> <option  value="MAIN">MAIN</option><option  value="PAGER">PAGER</option></select>');
                newDiv.appendTo("#Div1");
				newDiv2.appendTo("#Div2");

            });
        });
    </script>
</head>
<!--
http://www.seoppcsmm.com/post/1346471985/generate-qr-code-google-chart-api-bulk-excel-worksheet

 -->
 <?php 
 function getVarFromPOST($array)
{
	return array_intersect_key($_POST,$array);
}
 
 function getPhoneVarsFromPOST()
 {
	 $phoneArray[];
	 for($i=1; $i<$_POST.count; $i++){
		 $telCount = 'Phone'.i;
	 	$phoneArray[i] = $_POST[$telCount];
	 }
 }
 
 ?>
<body>

<?php
//create form and submit to own page. 
//then handle sending via googleapi
//attach image to an img tag in form for display. Can save it to db to retrieve again. 

//handle values to send to Google api
 $bus_card_array = array(
				'vCard' =>'vCard:',
				'fname' => 'FN:',
				'lname' =>'FN:',
				'title' =>'TITLE:',
				'org' =>'ORG:',
				'addr' =>'ADR;',
				'tel' =>'TEL:',
				'email' =>'EMAIL:',
				'website' =>'URL:'
				//'NOTE' =>:Company%20site:%20http://www.bluelinerny.com;
				);



if(isset($_POST['submit_app']))
{
	//defines form variables
	$form_array = array(
			'pkqr_id'=>'',
			'fname'=>'',
			'lname'=>'',
			'title'=>'',
			'org'=>'',
			'addr'=>'',
			'street'=>'',
			'city' => '',
			'prov_state'=>'',
			'postal'=>'',
			'country'=>'',
			'addrt'=>'',
			'tel'=>'',
			'telt'=>'',
			'email'=>'',
			'website'=>'');

	
	//call variable array that creates only array keys with values
	$post_vars=getVarFromPOST($form_array);
	$post_phone_vars = getPhoneVarsFromPOST();
	//print_r($_POST);
	$qr_vars = array_intersect_key($post_vars,$bus_card_array);
	//print_r($post_vars);
	echo "<br />";
	
	//append post_vars to the values we want in our buscard array to send to google
	//want to split the vars of buscard array with post var values but we want to also keep the begining of the buscardarray which means we have to add to the buscard array key[i] = value[i].postvar[i]
	$nameCount = -1;
	$keys = array_keys($qr_vars);
	$values = array_keys($post_vars);
	$string = 'BEGIN: VCard %0A VERSION:3.0%0A';
	foreach($values as $value){
		if (($value != 'pkqr_id') &&($value !='submit_app')){ 
			foreach($keys as $key)
			{
				if(($key ==$value) && ($post_vars[$value] !=''))
				{
					if (($key == 'fname') && ($value == 'fname'))
					{
						$nameCount=1;
						$bus_card_array[$key] = $bus_card_array[$key].$post_vars['lname'].';'.$post_vars['fname'];
						$string .=$bus_card_array[$key].'%0A';
					}else if(($key == 'addr') && ($post_vars['street'] !='street')){	
						//ADR;TYPE=WORK:;;100 Waters Edge;Baytown;LA;30314;United States of America
						if($post_vars['addrt'] !=''){
							$add_type ='TYPE='.$post_vars['addrt'].':;;';
						}
						$bus_card_array[$key] =$bus_card_array[$key].$add_type. $post_vars['street'].';'.$post_vars['city'].';'.$post_vars['prov_state'].';'.$post_vars['postal'].';'.$post_vars['country'];
						if($bus_card_array[$key] !='')
							$string .=$bus_card_array[$key].'%0A';
					}else if(($key == 'tel') && !($post_vars['tel'] =='')){	
						
						//TEL;TYPE=WORK:780-987-6543
						if($post_vars['telt'] !=''){
							$tel_type ='TYPE='.$post_vars['telt'].':';
						}
						
						$bus_card_array[$key] = $bus_card_array[$key].$tel_type. $post_vars['tel'];
						if($bus_card_array[$key] !='')
						$string .=$bus_card_array[$key].'%0A'; 
					}else{
						if(!($key == 'lname') && !($value == 'FN:')){
							$bus_card_array[$key] = $bus_card_array[$key].$post_vars[$value];
							//print_r($bus_card_array[$key]);
							$string .=$bus_card_array[$key].'%0A';
						
						}
					}
				}
			}
		}
	}
	$string .="END:VCARD%0A";
//print_r($bus_card_array);
//echo "<br />".$string ."<br />";
echo "<br />";
	if($_POST['pkqr_id'] =='new'){
		//echo "adding new";
		/*if ()) { 
			//$result=$m_application->createApplication( $post_vars);
		}else { 				
			// otherwise display existing image.
		}*/
	}
						
}

  // Create some random text-encoded data for a line chart.
 // header('content-type: image/png');
  //https://chart.googleapis.com/chart
  $url = 'https://chart.googleapis.com/chart?chid=' . md5(uniqid(rand(), true));


  // Add data, chart type, chart size, and scale to params.
  $chart = array(
    'cht' => 'qr',
    'chs' => '300x300',
	'chl' => $string,
    );

  // Send the request, and print out the returned bytes.
/*  $context = stream_context_create(
		array(
			'https' => array
				(
					'method' => 'POST',
					'content' => http_build_query($chart)
				)
		  )
	  );*/
  //fpassthru(fopen($url, 'r', false, $context));

?>


<form action='test2.php' method='POST'>
    <input type='hidden' name='pkqr_id' value='new'/>
    <table>
        <tr><td>Name:</td><td><input type="text" name="fname" value="First" onblur="if(this.value=='') this.value='First';" onfocus="if(this.value=='First') this.value='';" />
        <input type="text" name="lname" value="Last" onblur="if(this.value=='') this.value='Last';" onfocus="if(this.value=='Last') this.value='';" /></td>
        <tr><td>Title:</td><td><input type="text" name="title" value=""/> (optional)<br></td>

        <tr><td>Organzation:</td><td><input type="text" name="org" value=""/> (optional)<br></td>
        
        
        <tr><td valign="top">Address:</td>
                <td><table><tr>
                    <td>
                    <input type="hidden" name="addr" value="addr" />
                    	<input type="text" name="street" value="street" onblur="if(this.value=='') this.value='street';" onfocus="if(this.value=='street') this.value='';" /><br />
                    <input type="text" name="city" value="City" onblur="if(this.value=='') this.value='City';" onfocus="if(this.value=='City') this.value='';"  /><br />
                    <input type="text" name="prov_state" value="Province/State" onblur="if(this.value=='') this.value='Province/State';" onfocus="if(this.value=='Province/State') this.value='';"  /><br />
                    <input type="text" name="postal" value="Zip / Postal Code" onblur="if(this.value=='') this.value='Zip / Postal Code';" onfocus="if(this.value=='Zip / Postal Code') this.value='';" /><br />
                    <input type="text" name="country" value="Country" onblur="if(this.value=='') this.value='Country';" onfocus="if(this.value=='Country') this.value='';" /><br />
                    </td>
                    <td valign="top">
                         <select name="addrt">
              				<option value=""></option>
                            <option value="WORK">Work</option>
                            <option  value="HOME">Home</option>
                        </select>
                    </td>
                </tr>
                </table>
            </td>
            </tr>
        <tr>
          	<td>Phone Number:</td> <td valign="top">
                  <table>
                    <tr>
                        <td><input type="text" name="tel" value=""></td>
                        <td valign="top">
                        <select name="telt">
                          <option value=""></option>
                          <option value="WORK">Work</option>
                          <option value="WORK;Type=FAX">Work Fax</option>
                          <option  value="HOME">Home</option>
                          <option  value="HOME;Type=FAX">Home Fax</option>
                          <option  value="CELL">CELL</option>
                          <option  value="MAIN">MAIN</option>
                          <option  value="PAGER">PAGER</option>
                        </select>
                        <input type="button" name="addPhone" id="btnOfficial" value="Add Phone No."  />
                        <input type="hidden" value="1" id="theValue" runat="server" />
                        </td>
                   </tr>
                </table>
			</td>
        <tr>
        	<td></td>
            <td valign="top">
                  <table>
                    <tr>
                        <td>        
                        <div id="Div1">
                        </div>
                        </td>
                        <td>
                        <div id="Div2">
                        </div>
                        </td>
                    </tr>
                  </table>
            </td>
        </tr>
    
          </td>
        </tr>
        <tr>
        	<td>Email:</td>
            <td><input type="text" name="email" value=""> (optional)<br></td>
        </tr>
        <tr>
        	<td>Website:</td>
            <td><input type="text" name="website" value=""> (optional)<br></td>
       </tr>
        <tr>
        	<td></td>
            <td>(for example: http://www.nCapsule.com)</td>
        </tr>
<!--        <tr><td>Error Correction</td>
        	<td>
            <select name="ecl">
                  <option selected="true"value="L">Low</option>
                  <option  value="M">Medium</option>
                  <option value="Q">Medium-High</option>
                  <option value="H">High</option>
            </select>
            </td>
         </tr>
        <tr>
        	<td></td><td>(durability / ease of scan)</td>
        </tr>-->
    </table>
<br>
<br>
<input type="submit" value="Generate QRcode" name="submit_app">
</form>
  <?php 
  //can encode up to 4,296 alphanumeric characters
  if($nameCount ==1){
  	$urlEncodedString = http_build_query($chart);
  $urlDecodedString= urldecode($urlEncodedString);
  echo $urlDecodedString."<br/>";
  
  ?>
<img border="0"
src="<?php echo "https://chart.googleapis.com/chart?". http_build_query($chart); ?>"
alt="Your Company QR" /> 
<?php } ?>   
</body>
</html>