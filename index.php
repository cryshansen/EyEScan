<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

?>

<form>
First name: <input type="text" name="firstname" /><br />
Last name: <input type="text" name="lastname" /><br />
Title: <input type="text" name="title" /><br />
Nickname: <input type="text" name="title" /><br />
Role: <input type="text" name="title" /><br />
Organization: <input type="text" name="org" /><br />

//photo Upload<br />


Phone Type:
<table>
<tr><th>Home</th><th>Work</th></tr>
<tr>
<td>Voice:<input type="radio" name="add_type" /><br />
Fax:<input type="radio" name="add_type" /><br />
Cell:<input type="radio" name="add_type" /><br />
</td>
<td>Voice:<input type="radio" name="add_type" /><br />
Fax:<input type="radio" name="add_type" /><br />
Cell:<input type="radio" name="add_type" /><br />
</td>
</tr>
<tr><td>Tel: </td>
<td><input type="text" name="phone" /><br /></td></tr>

<input type="button" value="Add a Phone:"  name="add_phone" />
</table>
<br /><br />

Address: 
<table>
    <tr>
        <td>Home:<input type="radio" name="add_type" /><br /></td>
        <td>Work:<input type="radio" name="add_type" /><br /></td>
    </tr>
    <tr>
        <td>
        <input type="text" name="street" /><br />
        <input type="text" name="city" /><br />
        <input type="text" name="prov_state" /><br />
        <input type="text" name="postal" /><br />
        <input type="text" name="country" /><br />
        </td>
    </tr>
</table>

<input type="button" value="Add an Address" name="add_address" /><br /><br />

Email: <input type="text" name="email" /><br />

Website: <input type="text" name="web" /><br />


</form>

<!-- 

N:Gump;Forrest
FN:Forrest Gump12.01
ORG:Bubba Gump Shrimp Co.
TITLE:Shrimp Man
PHOTO;VALUE=URL;TYPE=PNG:http://www.printbusinesscards.com/w/images/classic/pbc_header_logo.png
TEL;TYPE=WORK,VOICE:(111) 555-1212
TEL;TYPE=HOME,VOICE:(404) 555-1212
ADR;TYPE=WORK:;;100 Waters Edge;Baytown;LA;30314;United States of America
LABEL;TYPE=WORK:100 Waters Edge\nBaytown, LA 30314\nUnited States of America
ADR;TYPE=HOME:;;42 Plantation St.;Baytown;LA;30314;United States of America
LABEL;TYPE=HOME:42 Plantation St.\nBaytown, LA 30314\nUnited States of America
EMAIL;TYPE=PREF,INTERNET:forrestgump@example.com
REV:20080424T195243Z
END:VCARD

 -->
</body>
</html>