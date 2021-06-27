<?php 
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$ret1=mysqli_query($bd,"delete FROM users where id='".$_GET['uid']."'");
?>

<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}ser
function f3()
{
window.print();
}
</script>
<!DOCTYPE">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete User</title>
<style>
input[type=text], select {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=text], textarea {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  background-color: #000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #black;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
table {
  border-collapse: collapse;
  width: 100%;
  table-align: center;
}

th { border-bottom: 1px solid #ddd;
  text-align: center;
  font-size: 40;
  padding: 8px;
}
td {
	border-bottom: 1px solid #ddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
</head>
<body>
<div style="margin-left:50px;">
 <form name="updateticket" id="updateticket" method="post"> 
<table width="100%" border="0.5" cellspacing="0" cellpadding="0" align="center">
	<tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr height="50">
      <td><b>User Is Sucessfully Deleted</b></td>
    </tr>
    <tr>
  
      <td colspan="2">   
      <center><input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="f2()" style="cursor: pointer;"  /></td></center>
	  </tr>
	  </table>
 </form>
</div>

</body>
</html>
<?php
}
?>
