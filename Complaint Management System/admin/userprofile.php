<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
  { 
header('location:index.php');
}
else{

 ?>
<script language="javascript" type="text/javascript">
function f2()
{
window.close();
}
function f3()
{
window.print(); 
}
</script>
<!DOCTYPE">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Profile</title>
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
<?php 

$ret1=mysqli_query($bd, "select * FROM users where id='".$_GET['uid']."'");
while($row=mysqli_fetch_array($ret1))
{
?>

    
  
		
    <th>
      <td colspan="2"><b><?php echo $row['fullName'];?>'s profile</b></td>
    </th>
    
    
    <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr height="50">
      <td><b>Reg Date:</b></td>
      <td><?php echo htmlentities($row['regDate']); ?></td>
    </tr>
    <tr height="50">
      <td><b>User Email:</b></td>
      <td><?php echo htmlentities($row['userEmail']); ?></td>
    </tr>


      <tr height="50">
      <td><b>User Contact no:</b></td>
      <td><?php echo htmlentities($row['contactNo']); ?></td>
    </tr>
    


        <tr height="50">
      <td><b>Address:</b></td>
      <td><?php echo htmlentities($row['address']); ?></td>
    </tr>



        <tr height="50">
      <td><b>State:</b></td>
      <td><?php echo htmlentities($row['State']); ?></td>
    </tr>


        <tr height="50">
      <td><b>Country:</b></td>
      <td><?php echo htmlentities($row['country']); ?></td>
    </tr>


        <tr height="50">
      <td><b>Pincode:</b></td>
      <td><?php echo htmlentities($row['pincode']); ?></td>
    </tr> 

    <tr height="50">
      <td><b>Year of Enrollment:</b></td>
      <td><?php echo htmlentities($row['year']); ?></td>
    </tr> 

    <tr height="50">
      <td><b>Adhar Number:</b></td>
      <td><?php echo htmlentities($row['adharno']); ?></td>
    </tr> 

    <tr height="50">
      <td><b>Adhar Id:</b></td>
      <td><a href="http://localhost/Complaint Management System/users/adharids/<?php echo htmlentities($row['AdharFile']);?>"> View File</a></td>
    </tr>  


        <tr height="50">
      <td><b>Last Updation:</b></td>
      <td><?php echo htmlentities($row['updationDate']); ?></td>
    </tr>
     <tr height="50">
      <td><b>Status:</b></td>
      <td><?php if($row['status']==1)
      { echo "Active";
} else{
  echo "Block";
}
        ?></td>
    </tr>
    
    <tr>
  
      <td colspan="2">   
      <center><input name="Submit2" type="submit" class="txtbox4" value="Close this window " onClick="f2()" style="cursor: pointer;"  /></td></center>
	  </tr>
   
    <?php } 

 
    ?>
 
</table>
 </form>
</div>

</body>
</html>

     <?php } ?>